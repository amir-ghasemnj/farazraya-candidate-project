<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "please using just following url: " . env('APP_URL') . "/api";
});
