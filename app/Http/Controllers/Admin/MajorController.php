<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Major;
use App\Traits\ImageDeletionTrait;
use App\Traits\ImageUploadTrait;
use App\Traits\NavigationDataTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\MajorRequest;

class MajorController extends Controller
{
    use NavigationDataTrait, ImageUploadTrait, ImageDeletionTrait;
    /**
     * Display a listing of the resource.
     */public function index()
{
    Gate::authorize('isSuperAdmin');

    $majors = Major::paginate(5);
    $navigationData = $this->getNavigationData();
    return view('web.admin.pages.majors.index', array_merge(['majors' => $majors], $navigationData));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('isSuperAdmin');
        $navigationData = $this->getNavigationData();
        return view('web.admin.pages.majors.create', $navigationData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MajorRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $this->handleImageUpload($request, $data['title'], 'major', 'majors');

        Major::create($data);

        return redirect()->route('adminmajors.index')->with('success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Major $major)
    {
        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.majors.edit', $navigationData, compact('major'));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(MajorRequest $request, Major $major)
     {
         $data = $request->validated();
         $imagePath = $this->handleImageUpload($request, 'major-' . time(), 'major', 'majors');
        if ($imagePath) {
            $data['image'] = $imagePath;
        }
         $major->update($data);
         return redirect()->route('adminmajors.index')->with('success', 'Updated Successfully!');
     }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {
        $this->deleteImage($major->image);
        $major->delete();
        return redirect()->route('adminmajors.index')->with('success', 'Deleted successfully!');
    }
}
