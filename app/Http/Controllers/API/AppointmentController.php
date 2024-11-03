<?php

namespace App\Http\Controllers\API;

use App\Models\Appointment;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::get();
        return $this->responseSuccess('Data Retrieved Successfully', $appointments->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        $Appointment = Appointment::create($request->validated());
        return $this->responseSuccess('Created Successfully', $Appointment->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $Appointment)
    {
        return $this->responseSuccess('Retreieved Successfully', $Appointment->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, Appointment $Appointment)
    {
        $Appointment->update($request->validated());
        return $this->responseSuccess('updated Successfully', $Appointment->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $Appointment)
    {
        $Appointment->delete();
        return $this->responseSuccess('Deleted Successfully', $Appointment->toArray());
    }
}
