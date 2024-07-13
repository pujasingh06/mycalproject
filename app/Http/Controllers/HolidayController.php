<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Holiday;

class HolidayController extends Controller
{
    /**
     * Get Holidays From DB & Display in Table
     * @param Nill
     * @return View holidays.table
     * @author Puja Singh
     */
    public function index()
    {
        $holidays = Holiday::all();
        return view('holidays.table', compact('holidays'));
    }

    /**
     * Get Holidays From DB & Display in Calendar Format
     * @param String $year
     * @param String $month
     * @return View holidays.calendar
     * @author Puja Singh
     */
    public function calendar($year, $month)
    {
        $monthName = \Carbon\Carbon::createFromDate($year, $month, 1)->format('F');
        $daysInMonth = \Carbon\Carbon::createFromDate($year, $month, 1)->daysInMonth;
        $previousMonth = $month == 1 ? 12 : $month - 1;
        $nextMonth = $month == 12 ? 1 : $month + 1;

        return view('holidays.calendar', compact('year', 'month', 'monthName', 'daysInMonth', 'previousMonth', 'nextMonth'));
    }

    /**
     * Fetch Holidays From API & Save In DB
     * @param Nill
     * @return Redirect calendar 
     * @author Puja Singh
     */
    public function fetchHoliday()
    {
        try {
            $response = Http::get('https://calendarific.com/api/v2/holidays', [
                'api_key' => env('CALENDARIFIC_API_KEY'),
                'country' => 'IN',
                'year' => date('Y')
            ]);
    
            $responseData =  $response->json();
            $holidays = $responseData['response']['holidays'];
    
            foreach ($holidays as $holiday) {
                Holiday::updateOrCreate([
                    'date' => $holiday['date']['iso'],
                    'name' => $holiday['name'],
                    'type' => $holiday['type'][0],
                ]);
            }
    
            return redirect()->route('calendar', ['year' => date('Y'), 'month' => date('m')]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
