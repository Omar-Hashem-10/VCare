<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;

trait ImageDeletionTrait
{
    /**
     * Delete an image if it exists.
     *
     * @param string|null $imagePath
     * @return bool
     */
    public function deleteImage(?string $imagePath): bool
    {
        if ($imagePath && File::exists($imagePath)) {
            return File::delete($imagePath);
        }
        return false;
    }
}
