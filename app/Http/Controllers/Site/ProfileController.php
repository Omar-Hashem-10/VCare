<?php

namespace App\Http\Controllers\Site;

use App\Models\User;
use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::get();
        $user = User::where("id", auth()->user()->id)->first();
        return view('web.site.pages.profile.index', compact('abouts', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $abouts = About::get();
        return view('web.site.pages.profile.edit', compact('abouts', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->all();

        if ($data['current_password'] != NULL) {
            if(!Hash::check($data['current_password'], $data['password'])){
                return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
            }else{
                if ($data['new_password'] != NUll) {
                    $data['password'] = $data['new_password'];
                }
            }
        }else{
            $data = $request->only('email', 'name');
        }


        if ($request->email !== $user->email) {
            $data['email'] = $request->email;
        } else {
            unset($data['email']);
        }


        $user->update($data);

        return redirect()->route('site.profile.index')->with('success', 'Profile updated successfully.');
    }
}
