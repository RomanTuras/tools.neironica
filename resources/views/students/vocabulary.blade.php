@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Добавить в словарь</h1>
</div>

<vocabulary-component v-bind:data="{{ json_encode(
                    array(
                        'languages' => $data['languages'],
                        'varieties' => $data['varieties'],
                        'userId' => $data['user_id'],
                        )) }}">

</vocabulary-component>

@endsection
