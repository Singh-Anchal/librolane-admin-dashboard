<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('dashboard');
});

Route::get('/log-in', function () {
    return view('login');
});

Route::get('/attandence', function () {
    return view('attandence');
});

Route::get('/student', function () {
    return view('student');
});

Route::get('/staff', function () {
    return view('staff');
});
Route::get('/academics', function () {
    return view('academics');
});

Route::get('/finance', function () {
    return view('finance');
});

