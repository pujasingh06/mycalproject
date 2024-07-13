@extends('layouts.holiday-layout')

@section('content')
<h1>Calendar</h1>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="calendar">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($holidays as $holiday)
                            <tr>
                                <td>{{ $holiday->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($holiday->date)->format('d/m/Y') }}</td>
                                <td>{{$holiday->type}} </td>
                               
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection