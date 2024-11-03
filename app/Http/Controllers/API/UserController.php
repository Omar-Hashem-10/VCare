<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return $this->responseSuccess('Data Retrieved Successfully', $users->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->validated());
        return $this->responseSuccess('Created Successfully', $user->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $this->responseSuccess('Retreieved Successfully', $user->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());
        return $this->responseSuccess('updated Successfully', $user->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->responseSuccess('Deleted Successfully', $user->toArray());
    }
}
