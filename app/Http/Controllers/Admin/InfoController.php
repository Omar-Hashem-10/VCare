<?php

namespace App\Http\Controllers\Admin;

use App\Models\Info;
use App\Models\Role;
use App\Models\Major;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Traits\ImageDeletionTrait;
use App\Traits\NavigationDataTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\InfoRequest;


class InfoController extends Controller
{
    use NavigationDataTrait, ImageUploadTrait, ImageDeletionTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('isSuperAdmin');

        $infos = Info::paginate(5);
        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.info.index', $navigationData, compact('infos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.info.create', $navigationData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InfoRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $this->handleImageUpload($request, $data['title'], 'info', 'infos');

        Info::create($data);
        return redirect()->route('admininfo.index')->with('success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Info $info)
    {
        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.info.edit', $navigationData, compact('info'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InfoRequest $request, Info $info)
    {
        $data = $request->validated();
        $imagePath = $this->handleImageUpload($request, 'info-' . time(), 'info', 'infos');
        if ($imagePath) {
            $data['image'] = $imagePath;
        }
        $info->update($data);
        return redirect()->route('admininfo.index')->with('success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Info $info)
    {
        $this->deleteImage($info->image);
        $info->delete();
        return redirect()->route('admininfo.index')->with('success', 'Deleted successfully!');
    }
}
