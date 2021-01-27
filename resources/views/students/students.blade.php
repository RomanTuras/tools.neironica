@extends('layouts.app')

@section('content')
    <vocabulary-component v-bind:data="{{ json_encode(
                    array(
                        'languages' => $data['languages'],
                        'varieties' => $data['varieties'],
                        'userId' => $data['user_id'],
                        'students' => $data['students'],
                        )) }}">

    </vocabulary-component>
@endsection
