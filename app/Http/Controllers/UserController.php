<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->search(request('search'))
            ->with('company')
            ->paginate();

        return view('users', compact('users'));
    }
}
