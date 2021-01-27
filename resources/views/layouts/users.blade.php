@extends('layouts.app')

@section('content')
    <div class="content">
        <h1 class="text-center" style="margin-bottom: 50px;">Пользователи</h1>
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Имя</th>
                        <th scope="col">Email</th>
                        <th scope="col">Роль</th>
                        <th scope="col">Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['users'] as $user)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td><a href="{{ URL::current().'/user-review/'.$user->id }}" style="font-size: 18px;"><i class="fa fa-edit"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
