<?php

use App\Http\Controllers\Api\Bookcontroler;
use Illuminate\Support\Facades\Route;

Route::apiResource('books', Bookcontroler::class);
