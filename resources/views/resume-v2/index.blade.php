@extends('resume-v2.layout')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-end my-4">
            <form action="{{ URL::to('api/resume/download') }}" method="post">
                <button class="btn btn-primary">Export to PDF</button>
            </form>
        </div>
    </div>

    <div style="font-size: normal;" class="container">
        @include('resume-v2.raw')
    </div>
@endsection
