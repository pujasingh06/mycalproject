<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HolidayController;

Route::get('/', function () {
    return redirect()->route('holidays.get');
});

Route::get('/getHoliday',[HolidayController::class, 'fetchHoliday'])->name('holidays.get');
Route::get('/holidays',[HolidayController::class, 'index'])->name('holidays');
Route::get('/calendar/{year}/{month}',[HolidayController::class, 'calendar'])->name('calendar');

