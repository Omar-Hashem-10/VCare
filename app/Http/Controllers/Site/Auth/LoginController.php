<?php

namespace App\Http\Controllers\Site\Auth;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function show()
    {
        $abouts = About::get();
        return view('web.site.Auth.login', compact('abouts'));
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && ($user->role->name === 'superadmin' || $user->role->name === 'admin' || $user->role->name === 'doctor')) {
            return back()->withErrors([
                'email' => 'You do not have access to this site.',
            ])->onlyInput('email');
        }

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
