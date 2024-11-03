<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ImageUploadTrait
{
    /**
     * Handle image upload and return the path.
     */
    private function handleImageUpload(Request $request, $title, $major, $path)
    {
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $fileName = $major . '-' . $title . '.' . $extension;
            $filePath = $file->storeAs($path, $fileName, 'public');
            return 'storage/' . $filePath;
        }
        return null;
    }
}
