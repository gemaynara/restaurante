<?php

namespace App\Helpers;

use App\Models\Produto;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Helper
{
    public static function uploadImage($file, $disk = 'imagens')
    {
        $extensions = ['jpg', 'jpeg', 'png']; // all extension type for images

        $isImage = $file->getClientOriginalExtension();
        if (!in_array($isImage, $extensions)) {
            return false;
        }

        $fileName = time() . '-' . $file->hashName();

        $upload = Storage::disk($disk)->put($fileName, File::get($file));
        if ($upload) {
            return $fileName;
        }

        return false;

    }



}
