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

    Route::get('/academic-calender', function () {
        return view('academic-calender');
    });

    Route::get('/time-table', function () {
        return view('time-table');
    });

Route::get('/finance', function () {
    return view('finance');
});

Route::get('/communications', function () {
    return view('communications');
});

Route::get('/reports', function () {
    return view('reports');
});
Route::get('/settings/security', function () {
    return view('settings.security');
});


