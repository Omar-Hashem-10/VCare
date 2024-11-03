<?php

namespace App\Http\Controllers\Site;

use App\Models\About;
use App\Models\Major;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::with('major')->paginate(8);
        $abouts = About::get();
        return view('web.site.pages.doctors.index', compact('doctors', 'abouts'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $abouts = About::get();

        $abouts = About::get();
        $major = Major::find($id);

        if ($major) {
            $doctors = $major->doctors()->paginate(8);
        } else {
            $doctors = Doctor::with('major')->paginate(8);
        }

        return view('web.site.pages.doctors.index', compact('doctors', 'abouts'));
    }
}
