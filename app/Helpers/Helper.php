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

    public static function generateNumber($lenght)
    {
        $random = '';
        for ($i = 0; $i < $lenght; $i++) {
            $random .= rand(0, 1) ? rand(0, 9) : chr(rand(ord('0'), ord('9')));
        }
        return $random;
    }

    public static function generateUsername($string)
    {
        return preg_replace('/(\S+) (\S{2}).*/', '$1$2', strtolower($string)) . random_int(0, 9999);
    }


}
