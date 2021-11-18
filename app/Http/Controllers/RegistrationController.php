<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:30'
        ]);


        if (Auth::user() && Auth::user()->can('manage', User::class)) $request->merge([
            'role' => 'employee',
            'manager_id' => Auth::user()->id
        ]) ;

        $user = User::create($request->all());

        if (!Auth::user()) {
            auth()->login($user);
            return redirect()->to('/');
        }

        return redirect()->to('/');
    }
}
