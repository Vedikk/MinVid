<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AllUsersController extends Controller
{
    public function show(){

        $users = User::all();

        return view('all_users')->with('users', $users);
    }
}
