@extends('layouts.holiday-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Holiday Calendar - {{ $year }} {{ $monthName }}</h1>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 1; $i <= $daysInMonth; $i++)
                            @php
                                $date = \Carbon\Carbon::createFromDate($year, $month, $i);
                                $holiday = \App\Models\Holiday::where('date', $date->format('Y-m-d'))->first();
                            @endphp
                            <td @if($holiday) style="color:green" @endif>
                                {{ $date->format('d') }}
                                @if($holiday)
                                    <br>
                                    {{ $holiday->name }} 
                                @endif
                            </td>
                            @if($i % 7 == 0)
                                </tr><tr>
                            @endif
                        @endfor
                    </tbody>
                </table>
                <div class="btn-group">
                    <a href="{{ route('calendar', ['year' => $year, 'month' => $previousMonth]) }}" class="btn btn-default">Previous</a>
                    <a href="{{ route('calendar', ['year' => $year, 'month' => $nextMonth]) }}" class="btn btn-default">Next</a>
                </div>
            </div>
        </div>
    </div>
@endsection