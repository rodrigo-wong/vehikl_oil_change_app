<?php

namespace App\Http\Controllers;

use App\Models\OilChange;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\OilChange\StoreRequest;

class OilChangeController extends Controller
{
    /** Display the form to create a new OilChange. */
    public function create(): View
    {
        return view('oil_changes.create');
    }

    /**
     * Store a newly created OilChange in DB and redirect to the result view.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $isDue =
            ($validated['current_odometer'] - $validated['prev_odometer']) >= 5000
            || now()->greaterThan(
                Carbon::parse($validated['prev_oil_change_date'])->addMonths(6)
            );
        $validated['is_due'] = $isDue;
        $oilChange = OilChange::create($validated);
        return redirect()->route('oil_changes.show', ['id' => $oilChange->id]);
    }

    public function show(string $id): View
    {
        $oilChange = OilChange::findOrFail($id);
        return view('oil_changes.show', ['oilChange' => $oilChange]);
    }
}
