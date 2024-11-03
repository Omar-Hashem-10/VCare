<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Major;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Traits\ImageDeletionTrait;
use App\Traits\NavigationDataTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\DoctorRequest;


class DoctorController extends Controller
{
    use NavigationDataTrait, ImageUploadTrait, ImageDeletionTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('isSuperAdmin');

        $majorId = $request->input('major_id');

        $doctors = Doctor::with('major')
                        ->when($majorId, function ($query) use ($majorId) {
                            return $query->where('major_id', $majorId);
                        })
                        ->paginate(5);

        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.doctors.index', $navigationData, compact('doctors', 'majorId'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $major_id = $request->input('major_id');

        session(['major_id' => $major_id]);

        $doctorRoleId = Role::where('name', 'doctor')->first()->id;
        $doctors = User::where('role_id', $doctorRoleId)
                        ->orderBy('created_at', 'desc')
                        ->get();

        $majors = Major::get();

        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.doctors.create', $navigationData, compact('majors', 'doctors', 'major_id'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(DoctorRequest $request)
    {
        $data = $request->validated();

        $major_id = session('major_id');

        $data['major_id'] = $major_id;

        $data['image'] = $this->handleImageUpload($request, $data['name'], 'doctor', 'doctors');

        Doctor::create($data);

        return redirect()->route('admindoctors.index', ['major_id' => $major_id])->with('success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor, Request $request)
    {
        $doctorRoleId = Role::where('name', 'doctor')->first()->id;
        $doctors = User::where('role_id', $doctorRoleId)
                        ->orderBy('created_at', 'desc')
                        ->get();
        $major_id = $request->input('major_id');
        $majors = Major::get();
        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.doctors.edit', $navigationData, compact('doctor', 'majors', 'major_id', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $data = $request->validated();

        $data['major_id'] = $request->input('major_id');

        $imagePath = $this->handleImageUpload($request, 'doctor-' . time(), 'doctor', 'doctors');
        if ($imagePath) {
            $data['image'] = $imagePath;
        }

        $doctor->update($data);

        return redirect()->route('admindoctors.index', ['major_id' => $request->major_id])->with('success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $major_id = $doctor->major_id;

        $this->deleteImage($doctor->image);
        $doctor->delete();
        return redirect()->route('admindoctors.index', ['major_id' => $major_id])->with('success', 'Deleted successfully!');
    }
}
