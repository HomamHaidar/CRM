<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait MangeImage
{
    public function addImage($request, $image_request, $Storage)
    {
        if ($request->hasfile($image_request)) {
            $filePath = Storage::disk($Storage)->put('images/', request()->file($image_request));
            return $filePath;
        }

    }

    public function updateImage($old_image, $image_request, $Storage)
    {
        Storage::disk('public')->delete($old_image);
        $filePath = Storage::disk($Storage)->put('images/', request()->file($image_request), 'public');
        return $filePath;
    }

    public function deleteImage($image,$Storage)
    {
        Storage::disk($Storage)->delete($image);
    }
}
