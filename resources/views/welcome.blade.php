@extends('layouts.holiday-layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href={{route('route.getHoliday')}} class="btn btn-primary">Get Holidays</a>
        </div>
    </div>
</div>
@endsection