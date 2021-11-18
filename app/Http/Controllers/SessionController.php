<?php

namespace App\Http\Controllers;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        $this->validate(request(),[
            'email' => 'required|email',
            'password' => 'required|min:6|max:30'
        ]);
        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors([
                'message' => 'The email or password is incorrect, please try again'
            ]);
        }

        return redirect()->to('/post');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect()->to('/login');
    }
}
