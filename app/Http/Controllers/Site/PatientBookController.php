<?php

namespace App\Http\Controllers\Site;

use App\Models\Book;
use App\Models\About;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Traits\NavigationDataTrait;
use App\Http\Controllers\Controller;

class PatientBookController extends Controller
{
    use NavigationDataTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::all();

        $books = Book::where('user_id', auth()->user()->id)->get();

        return view('web.site.pages.book.index', compact('abouts', 'books'));
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
        $book = Book::find($id);

        if (!$book) {
            return redirect()->route('site.patient-book.index')->with('error', 'Book not found.');
        }

        $abouts = About::get();
        $appointments = Appointment::where('doctor_id', $book->doctor_id)->get();

        $timeSlots = [];
        foreach ($appointments as $appointment) {
            $timeSlots[$appointment->id] = $this->generateTimeSlots($appointment->start_time, $appointment->end_time);
        }

        $navigationData = $this->getNavigationData();
        return view('web.site.pages.book.edit', compact('book', 'abouts', 'appointments', 'timeSlots'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, $id)
    {
        $book = Book::findOrFail($id);

        $updated = $book->update($request->validated());

        if (!$updated) {
            dd('Update failed');
        }

        return redirect()->route('site.patient-book.index')->with('success', 'Updated Successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return redirect()->route('site.patient-book.index')->with('error', 'Book not found.');
        }

        $book->delete();

        return redirect()->route('site.patient-book.index')->with('success', 'Deleted successfully!');
    }

}
