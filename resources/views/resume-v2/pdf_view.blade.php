@extends('resume-v2.layout')
@section('content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }
    </style>
    <div style="font-size:12px">
        @include('resume-v2.raw')
    </div>
@endsection
