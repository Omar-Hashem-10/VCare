<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Traits\NavigationDataTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    use NavigationDataTrait;

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        $navigationData = $this->getNavigationData();
        $user = User::find($request->user);
        return view('web.admin.pages.profile.edit', compact("user","navigationData"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $data = $request->all();

        if ($request->current_password && !Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        if ($request->email !== $user->email) {
            $data['email'] = $request->email;
        } else {
            unset($data['email']);
        }

        if ($request->new_password) {
            $data['password'] = $request->new_password;
        }


        $user->update($data);

        $user_id = session('user_id');

        return redirect()->route('admindoctor-profile.show', ['user' => $user_id])->with('success', 'Profile updated successfully.');
    }

    public function show(User $user)
    {
        $navigationData = $this->getNavigationData();
        return view('web.admin.pages.profile.show', $navigationData, compact('user'));
    }
}
