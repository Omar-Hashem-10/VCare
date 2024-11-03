<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Major;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Traits\ImageDeletionTrait;
use App\Traits\NavigationDataTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\SliderRequest;


class SliderController extends Controller
{
    use NavigationDataTrait, ImageUploadTrait, ImageDeletionTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('isSuperAdmin');

        $sliders = Slider::paginate(5);
        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.sliders.index', $navigationData, compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.sliders.create', $navigationData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $this->handleImageUpload($request, $data['title'], 'slider', 'sliders');

        Slider::create($data);
        return redirect()->route('adminsliders.index')->with('success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.sliders.edit', $navigationData, compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, Slider $slider)
    {
        $data = $request->validated();
        $imagePath = $this->handleImageUpload($request, 'slider-' . time(), 'slider', 'sliders');
        if ($imagePath) {
            $data['image'] = $imagePath;
        }
        $slider->update($data);
        return redirect()->route('adminsliders.index')->with('success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $image_path = $slider->image;
        $this->deleteImage($slider->image);
        $slider->delete();
        return redirect()->route('adminsliders.index')->with('success', 'Deleted successfully!');
    }
}
