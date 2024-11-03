<?php

namespace App\Http\Controllers\Site;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\About;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Controllers\Controller;

class BookController extends Controller
{

    private function generateTimeSlots($start_time, $end_time)
{
    $slots = [];
    $start = strtotime($start_time);
    $end = strtotime($end_time);

    while ($start <= $end) {
        $slots[] = date('g:i A', $start);
        $start = strtotime('+1 hour', $start);
    }

    return $slots;
}

    /**
     * Store a newly created resource in storage.
    */

public function store(Request $request)
{
    if (!auth()->check()) {
        return redirect()->route('site.auth.login.show')->with('error', 'You must be logged in to book an appointment.');
    }

    $user_id = auth()->id();

    $doctor_id = session('doctor_id');

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:15',
        'email' => 'required|email',
        'time' => 'required',
    ]);

    $validatedData['user_id'] = $user_id;
    $validatedData['doctor_id'] = $doctor_id;

    Book::create($validatedData);

    return redirect()->route('site.doctor')->with('success', 'Appointment booked successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        session(['doctor_id' => $id]);

        $abouts = About::get();

        $doctor = Doctor::with('major')->find($id);

        if (!$doctor) {
            return redirect()->route('doctor')->with('error', 'Doctor not found');
        }

        $appointments = Appointment::where('doctor_id', $doctor->id)->get();

        $timeSlots = [];

        foreach ($appointments as $appointment) {
            $timeSlots[$appointment->id] = $this->generateTimeSlots($appointment->start_time, $appointment->end_time);
        }

        return view('web.site.pages.doctors.doctor', compact('doctor', 'abouts', 'appointments', 'timeSlots'));
    }
}
