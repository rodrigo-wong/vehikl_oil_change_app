<?php

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('successfully loads the oil change create form', function () {
    $this->get(route('oil_changes.create'))
        ->assertStatus(200);
});

test('oil change is due by distance (>= 5000 km)', function () {
    $payload = [
        'current_odometer' => 15000,
        'prev_odometer' => 9000,
        'prev_oil_change_date' => Carbon::now()->subMonth()->toDateString(),
    ];

    $this->post(route('oil_changes.store'), $payload)
        ->assertRedirect();

    $this->assertDatabaseHas('oil_changes', [
        'current_odometer' => 15000,
        'prev_odometer' => 9000,
        'prev_oil_change_date' => $payload['prev_oil_change_date'],
        'is_due' => true,
    ]);
});

test('oil change is due by time (> 6 months)', function () {
    $payload = [
        'current_odometer' => 12000,
        'prev_odometer' => 9000,
        'prev_oil_change_date' => Carbon::now()->subMonths(7)->toDateString(),
    ];

    $this->post(route('oil_changes.store'), $payload)
        ->assertRedirect();

    $this->assertDatabaseHas('oil_changes', [
        'current_odometer' => 12000,
        'prev_odometer' => 9000,
        'prev_oil_change_date' => $payload['prev_oil_change_date'],
        'is_due' => true,
    ]);
});

test('oil change is NOT due (< 5000 km AND within 6 months)', function () {
    $payload = [
        'current_odometer' => 13000,
        'prev_odometer' => 9000, 
        'prev_oil_change_date' => Carbon::now()->subMonths(2)->toDateString(),
    ];

    $this->post(route('oil_changes.store'), $payload)
        ->assertRedirect();

    $this->assertDatabaseHas('oil_changes', [
        'current_odometer' => 13000,
        'prev_odometer' => 9000,
        'prev_oil_change_date' => $payload['prev_oil_change_date'],
        'is_due' => false,
    ]);
});

test('oil change is due by date even if distance < 5000 km', function () {
    $payload = [
        'current_odometer' => 14000,
        'prev_odometer' => 10000,
        'prev_oil_change_date' => Carbon::now()->subMonths(8)->toDateString(),
    ];

    $this->post(route('oil_changes.store'), $payload)
        ->assertRedirect();

    $this->assertDatabaseHas('oil_changes', [
        'current_odometer' => 14000,
        'prev_odometer' => 10000,
        'prev_oil_change_date' => $payload['prev_oil_change_date'],
        'is_due' => true,
    ]);
});

test('validation fails for future oil change date and current odometer < previous odometer', function () {
    $this->post(route('oil_changes.store'), [
        'current_odometer' => 10000,
        'prev_odometer' => 20000,
        'prev_oil_change_date' => Carbon::now()->addDay()->toDateString(),
    ])
    ->assertSessionHasErrors([
        'current_odometer',
        'prev_oil_change_date',
    ]);
});

test('shows the oil change result page', function () {
    $oilChange = \App\Models\OilChange::create([
        'current_odometer' => 18000,
        'prev_odometer' => 11000,
        'prev_oil_change_date' => Carbon::now()->subMonth()->toDateString(),
        'is_due' => true,
    ]);

    $this->get(route('oil_changes.show', ['id' => $oilChange->id]))
        ->assertStatus(200);
});
