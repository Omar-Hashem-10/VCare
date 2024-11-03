<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\About;
use App\Models\Major;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Traits\ImageDeletionTrait;
use App\Traits\NavigationDataTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\AboutRequest;


class AboutController extends Controller
{
    use NavigationDataTrait, ImageUploadTrait, ImageDeletionTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('isSuperAdmin');

        $abouts = About::paginate(5);
        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.about.index', $navigationData, compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.about.create', $navigationData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AboutRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $this->handleImageUpload($request, $data['description'], 'about', 'abouts');

        About::create($data);
        return redirect()->route('adminabout.index')->with('success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.about.edit', $navigationData, compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AboutRequest $request, About $about)
    {
        $data = $request->validated();
        $imagePath = $this->handleImageUpload($request, 'about-' . time(), 'about', 'abouts');
        if ($imagePath) {
            $data['image'] = $imagePath;
        }
        $about->update($data);
        return redirect()->route('adminabout.index')->with('success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        $this->deleteImage($about->image);
        $about->delete();
        return redirect()->route('adminabout.destroy')->with('success', 'Deleted successfully!');
    }
}
