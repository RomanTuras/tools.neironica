@extends('layouts.app')

@section('content')
    <vocabulary-exercise-component v-bind:data="{{ json_encode(
                    array(
                        'languages' => $data['languages'],
                        'varieties' => $data['varieties'],
                        'userId' => $data['user_id'],
                        )) }}">

    </vocabulary-exercise-component>
@endsection
