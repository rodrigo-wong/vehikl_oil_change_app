<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('oil_changes.create');
});
