<?php

namespace App\Http\Controllers;

use App\User;
use http\Env\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $users = User::getAllUsers();
            $roles = ['admin', 'teacher', 'student'];
        }
        else {
            $users = [];
            $roles = [];
        }
        return view('layouts.users',
            ['data' =>
                 [
                     'page' => 'users',
                     'users' => $users,
                     'roles' => $roles,
                 ]
            ]);
    }

    /**
     * Getting users
     * @return \Illuminate\Support\Collection
     */
    public function getUsers() {
        return User::getAllUsers();
    }

    /**
     * Delete user and all his data
     * @param $userId
     */
    public function deleteUser($userId) {
        $user = new User();
        $user->deleteUser($userId);
    }

    /**
     * Change user role
     * @param $userId
     * @param $role
     */
    public function changeUserRole($userId, $role){
        $user = new User();
        $user->updateUserRole($userId, $role);
    }
}
