<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class OilChangeController extends Controller
{
    public function create(): View
    {
        return view('oil_changes.create');
    }
}
