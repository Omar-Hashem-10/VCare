<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Major;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Traits\NavigationDataTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\AppointmentRequest;

class AppointmentController extends Controller
{
    use NavigationDataTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('isSuperAdmin');

        if ($request->has('major_id')) {
            $doctors = Doctor::where('major_id', $request->major_id)->pluck('id');

            $appointments = Appointment::with('doctor')
                ->whereIn('doctor_id', $doctors)
                ->paginate(5)
                ->appends(['major_id' => $request->major_id]);
        } else {
            $appointments = Appointment::with('doctor')->paginate(5);
        }

        $navigationData = $this->getNavigationData();


        $major_new_appointment = $request->major_id;

        return view('web.admin.pages.appointment.index', $navigationData, compact('appointments','major_new_appointment'));
    }


    /**
     * Show the form for creating a new resource.
     */
/**
 * Show the form for creating a new resource.
 */
    public function create(Request $request)
    {
        $navigationData = $this->getNavigationData();

        $selectedMajorId = $request->input('major_id');

        if ($selectedMajorId) {
            $doctors = Doctor::where('major_id', $selectedMajorId)->with('major')->get();
        } else {
            $doctors = Doctor::with('major')->get();
        }


        return view('web.admin.pages.appointment.create', $navigationData, compact('doctors', 'selectedMajorId'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        Appointment::create($request->validated());
        return redirect()->route('adminappointments.create')->with('success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment, Request $request)
    {
        $navigationData = $this->getNavigationData();

        $selectedMajorId = $request->input('major_id', $appointment->doctor->major_id ?? null);
        $doctors = $selectedMajorId
            ? Doctor::where('major_id', $selectedMajorId)->with('major')->get()
            : Doctor::with('major')->get();


        return view('web.admin.pages.appointment.edit', $navigationData, compact('appointment', 'selectedMajorId', 'doctors'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, Appointment $appointment)
    {
        $appointment->update($request->validated());
        return redirect()->route('adminappointments.index')->with('success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('adminappointments.index')->with('success', 'Deleted successfully!');
    }
}
