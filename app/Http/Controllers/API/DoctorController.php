<?php

namespace App\Http\Controllers\API;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DoctorRequest;

class DoctorController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::get();
        return $this->responseSuccess('Data Retrieved Successfully', $doctors->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorRequest $request)
    {
        $doctor = Doctor::create($request->validated());
        return $this->responseSuccess('Created Successfully', $doctor->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        return $this->responseSuccess('Retreieved Successfully', $doctor->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->validated());
        return $this->responseSuccess('updated Successfully', $doctor->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return $this->responseSuccess('Deleted Successfully', $doctor->toArray());
    }
}
