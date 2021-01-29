@extends('layouts.app')

@section('content')
    <user-action-component v-bind:data="{{ json_encode(
                    array(
                        'users' => $data['users'],
                        'roles' => $data['roles'],
                        )) }}">

    </user-action-component>
@endsection
