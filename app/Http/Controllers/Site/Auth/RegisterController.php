<?php

namespace App\Http\Controllers\Site\Auth;

use App\Models\Role;
use App\Models\User;
use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Site\RegisterRequest;

class RegisterController extends Controller
{
    public function show()
    {
        $abouts = About::get();
        return view('web.site.Auth.register', compact('abouts'));
    }

    public function register(RegisterRequest $request, Role $role): RedirectResponse
    {
        $data = $request->validated();

        $role = Role::where('name', $request->input('type'))->first();

        if ($role) {
            $data['role_id'] = $role->id;
        } else {
            return redirect()->back()->withErrors(['type' => 'Role not found']);
        }

        $user = User::create($data);

        Auth::login($user);

        return redirect()->route('site.home')->with('success', 'User registered successfully');
    }
}
