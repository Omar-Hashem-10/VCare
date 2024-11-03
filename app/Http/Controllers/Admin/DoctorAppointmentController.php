<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;

class DoctorAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $doctor_id = $request->doctor_id;

        if ($doctor_id) {
            session(['doctor_id' => $doctor_id]);
        } else {
            $doctor_id = session('doctor_id');
        }

        if ($doctor_id) {
            $appointments = Appointment::where('doctor_id', $doctor_id)->get();
        } else {
            $appointments = [];
        }

        return view('web.admin.pages.doctor-appointment.index', compact('appointments', 'doctor_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $doctor_id = $request->input('doctor_id');

        $doctor = Doctor::find($doctor_id);

        return view('web.admin.pages.doctor-appointment.create', compact('doctor', 'doctor_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        Appointment::create($request->validated());
        $doctor_id = session('doctor_id');

        return redirect()->route('admindoctor-appointment.index', ['doctor_id' => $doctor_id])->with('success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);

        $doctor = Doctor::find($appointment->doctor_id);

        return view('web.admin.pages.doctor-appointment.edit', compact('appointment', 'doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $validatedData = $request->validated();

        $appointment->appointment_date = $validatedData['appointment_date'];
        $appointment->start_time = $validatedData['start_time'];
        $appointment->end_time = $validatedData['end_time'];
        $appointment->doctor_id = $validatedData['doctor_id'];

        if ($appointment->save()) {
            return redirect()->route('admindoctor-appointment.index', ['doctor_id' => session('doctor_id')])
                             ->with('success', 'Appointment Updated Successfully!');
        } else {
            return redirect()->back()->withErrors('Failed to update the appointment.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        $doctor_id = session('doctor_id');

        return redirect()->route('admindoctor-appointment.index', ['doctor_id' => $doctor_id])->with('success', 'Deleted successfully!');
    }
}
