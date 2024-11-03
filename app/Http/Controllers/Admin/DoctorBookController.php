<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Traits\NavigationDataTrait;
use App\Http\Controllers\Controller;

class DoctorBookController extends Controller
{
    use NavigationDataTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user_id = $request->user_id;

        if ($user_id) {
            session(['user_id' => $user_id]);
        } else {
            $user_id = session('user_id');
        }

        if ($user_id) {
            $books = Book::where('doctor_id', $user_id)->get();
        } else {
            $books = [];
        }


        return view('web.admin.pages.doctor-book.index', compact('books'));
    }

    protected function generateTimeSlots($startTime, $endTime)
    {
        $timeSlots = [];
        $start = \Carbon\Carbon::parse($startTime);
        $end = \Carbon\Carbon::parse($endTime);

        while ($start <= $end) {
            $timeSlots[] = $start->format('H:i');
            $start->addMinutes(30);
        }

        return $timeSlots;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);

        if (!$book) {
            return redirect()->route('site.patient-book.index')->with('error', 'Book not found.');
        }

        $appointments = Appointment::where('doctor_id', $book->doctor_id)->get();

        $timeSlots = [];
        foreach ($appointments as $appointment) {
            $timeSlots[$appointment->id] = $this->generateTimeSlots($appointment->start_time, $appointment->end_time);
        }

        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.doctor-book.edit', compact('book', 'appointments', 'timeSlots', 'navigationData'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $validatedData = $request->validated();

        $book->name = $validatedData['name'];
        $book->phone = $validatedData['phone'];
        $book->email = $validatedData['email'];
        $book->time = $validatedData['time'];
        $book->status = $validatedData['status'];
        $book->doctor_id = $validatedData['doctor_id'];
        $book->user_id = $validatedData['user_id'];

        if ($book->save()) {
            return redirect()->route('admindoctor-books.index', ['user_id' => session('user_id')])
                                ->with('success', 'Updated Successfully!');
        } else {
            return redirect()->back()->withErrors('Failed to update the book.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        $user_id = session('user_id');

        return redirect()->route('admindoctor-books.index', ['user_id' => $user_id])->with('success', 'Deleted successfully!');
    }

}
