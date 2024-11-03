<?php

namespace App\Http\Controllers\Admin;

use App\Models\Download;
use Illuminate\Http\Request;
use App\Traits\ImageUploadTrait;
use App\Traits\ImageDeletionTrait;
use App\Traits\NavigationDataTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\DownloadRequest;

class DownloadController extends Controller
{
    use NavigationDataTrait, ImageUploadTrait, ImageDeletionTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $downloads = Download::get();
        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.download.index',  $navigationData,compact('downloads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.download.create', $navigationData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DownloadRequest $request)
    {
        $data = $request->validated();

        $data['image'] = $this->handleImageUpload($request, $data['title'], 'download', 'downloads');

        Download::create($data);
        return redirect()->route('admindownload.index')->with('success', 'Created Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Download $download)
    {
        $navigationData = $this->getNavigationData();

        return view('web.admin.pages.download.edit', $navigationData, compact('download'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DownloadRequest $request, Download $download)
    {
        $data = $request->validated();
        $imagePath = $this->handleImageUpload($request, 'download-' . time(), 'download', 'downloads');
        if ($imagePath) {
            $data['image'] = $imagePath;
        }
        $download->update($data);
        return redirect()->route('admindownload.index')->with('success', 'Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Download $download)
    {
        $this->deleteImage($download->image);
        $download->delete();
        return redirect()->route('admindownload.index')->with('success', 'Deleted successfully!');
    }
}
