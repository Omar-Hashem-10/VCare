<?php

namespace App\Http\Controllers\Admin;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Traits\ImageDeletionTrait;
use App\Traits\NavigationDataTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DoctorRequest;

class DoctorInformationController extends Controller
{
    use NavigationDataTrait, ImageUploadTrait, ImageDeletionTrait;

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        $navigationData = $this->getNavigationData();
        return view('web.admin.pages.doctor-information.show', $navigationData, compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        $navigationData = $this->getNavigationData();
        $doctor = Doctor::find($request->doctor);
        return view('web.admin.pages.doctor-information.edit', compact("doctor","navigationData"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DoctorRequest $request, Doctor $doctor)
    {
        $data = $request->validated();
        $data['major_id'] = $request->input('major_id');
        $data['user_id'] = $request->input('user_id');

        $imagePath = $this->handleImageUpload($request, 'doctor-' . time(), 'doctor', 'doctors');
        if ($imagePath) {
            $data['image'] = $imagePath;
        }

        $doctor->update($data);

        return redirect()->route('admindoctor-information.show', ['doctor' => $doctor->id])->with('success', 'Updated Successfully!');
    }

}
