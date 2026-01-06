<?php

use App\Models\OilChange;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('create oil change record and check if oil', function () {
    OilChange::create([
        'current_odometer' => 15000,
        'prev_oil_change_date' => '2025-12-05',
        'prev_odometer' => 9000,
        'is_due' => true,
    ]);

    $this->assertDatabaseHas('oil_changes', [
        'current_odometer' => 15000,
        'prev_oil_change_date' => '2025-12-05',
        'prev_odometer' => 9000,
        'is_due' => true,
    ]);
});
