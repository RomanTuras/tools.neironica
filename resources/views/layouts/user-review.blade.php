@extends('layouts.app')

@section('content')
    <div class="content">
        <h1 class="text-center" style="margin-bottom: 50px;">{{ $data['user']->name }}</h1>
        <div class="row">
            <div class="col-md-10 offset-md-1">

            </div>
        </div>
    </div>
@endsection
