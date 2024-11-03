<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Major;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Traits\NavigationDataTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use NavigationDataTrait;
    public function index(Request $request)
    {
        Gate::authorize('isSuperAdmin');
        $users = User::when($request->has('role_id'), function ($query) use ($request) {
                $query->where('role_id', $request->role_id);
            })
            ->paginate(5)
            ->appends($request->only('role_id'));

            $navigationData = $this->getNavigationData();

        if ($request->has('role_id')) {
            session(['selected_role' => $request->role_id]);
        }

        $selected_role = session('selected_role');
        $selected_role_name = Role::find($selected_role)->name ?? 'N/A';

        return view('web.admin.pages.users.index', $navigationData, compact('users', 'selected_role_name', 'selected_role'));
    }

    public function create(Request $request)
    {
        $roles = Role::all();
        $selectedRoleId = session('selected_role');
        $navigationData = $this->getNavigationData();


        return view('web.admin.pages.users.create', $navigationData, compact('roles', 'selectedRoleId'));
    }

    public function store(UserRequest $request)
    {
        User::create($request->validated());

        $selectedRoleId = session('selected_role');

        return redirect()->route('adminusers.index', ['role_id' => $selectedRoleId])->with('success', 'Created Successfully!');
    }


public function edit(string $id, Request $request)
{
    $user = User::findOrFail($id);
    $selectedRoleId = session('selected_role');
    $selectedRoleName = Role::find($selectedRoleId)->name ?? 'N/A';

    $roles = Role::all();
    $navigationData = $this->getNavigationData();


    return view('web.admin.pages.users.edit', $navigationData, compact('user', 'roles', 'selectedRoleId', 'selectedRoleName'));
}


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
        $selectedRoleId = session('selected_role');

        return redirect()->route('adminusers.index', ['role_id' => $selectedRoleId])->with('success', 'Updated Successfully!');
    }


    public function destroy(User $user)
    {
        $user->delete();
        $selectedRoleId = session('selected_role');
        return redirect()->route('adminusers.index', ['role_id' => $selectedRoleId])->with('success', 'Deleted successfully!');
    }
}
