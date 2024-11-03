<?php

namespace App\Http\Controllers\API;

use App\Models\Major;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MajorRequest;

class MajorController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = Major::get();
        return $this->responseSuccess('Data Retrieved Successfully', $majors->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MajorRequest $request)
    {
        $major = Major::create($request->validated());
        return $this->responseSuccess('Created Successfully', $major->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Major $major)
    {
        return $this->responseSuccess('Retreieved Successfully', $major->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MajorRequest $request, Major $major)
    {
        $major->update($request->validated());
        return $this->responseSuccess('updated Successfully', $major->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {
        $major->delete();
        return $this->responseSuccess('Deleted Successfully', $major->toArray());
    }
}
