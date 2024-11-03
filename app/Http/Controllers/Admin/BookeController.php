<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Role;
use App\Models\Major;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Traits\NavigationDataTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class BookeController extends Controller
{
    use NavigationDataTrait;
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        Gate::authorize('isSuperAdmin');
        $majorId = $request->input('major_id');

        if ($majorId) {
            session(['major_id' => $majorId]);
        } else {
            $majorId = session('major_id');
        }

        $doctors = Doctor::where('major_id', $majorId)->pluck('id');
        $books = Book::whereIn('doctor_id', $doctors)->paginate(5);

        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.book.index', $navigationData, compact('books'));
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
    public function edit($id, Major $major)
    {
        $book = Book::findOrFail($id);

        $appointments = Appointment::where('doctor_id', $book->doctor_id)->get();

        $timeSlots = [];
        foreach ($appointments as $appointment) {
            $timeSlots[$appointment->id] = $this->generateTimeSlots($appointment->start_time, $appointment->end_time);
        }

        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.book.edit', $navigationData, compact('book', 'appointments', 'timeSlots'));
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

        $majorId = session('major_id');

        return redirect()->route('adminbooks.index', ['major_id' => $majorId])->with('success', 'Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        $majorId = session('major_id');

        return redirect()->route('adminbooks.index', ['major_id' => $majorId])->with('success', 'Deleted successfully!');
    }

}
