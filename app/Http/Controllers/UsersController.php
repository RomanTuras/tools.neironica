<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function index()
    {
        $users = [];
        if (Gate::allows('isAdmin')) $users = User::getAllUsers();
        elseif (Gate::allows('isTeacher')) $users = User::getUsersForTeacher();
        return view('layouts.users',
            ['data' =>
                 [
                     'page' => 'users',
                     'users' => $users,
                 ]
            ]);
    }

    public function userReview($id) {
        return view('layouts.user-review',
            ['data' =>
                 [
                     'page' => 'users',
                     'user' => User::getUser($id)
                 ]
            ]);
    }
}
