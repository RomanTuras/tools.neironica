@extends('layouts/app')

@section('content')
    <puzzle-component v-bind:data="{{ json_encode(
                    array(
                        'folders' => $data['folders'],
                        )) }}">
    </puzzle-component>
@endsection
