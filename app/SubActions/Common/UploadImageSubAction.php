<?php

namespace App\SubActions\Common;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UploadImageSubAction
{
    public function run(UploadedFile $file, string $name, $folder, $disk = 'images'): string
    {
        $fileExtension = $file->getClientOriginalExtension();
        $milliseconds = floor(microtime(true) * 1000);
        $filename = generatorString($name) . '-' . $milliseconds . '.' . $fileExtension;
        $path = sprintf($folder);
        $width  = 0;
        $height = 0;
        $imageExtension = 'jpg';
        if ($width || $height) {
            return Image::make($file)->resize($width, $height)->encode($imageExtension);
        }

        $image = Image::make($file)->encode($imageExtension);
        Storage::disk($disk)->put($path . '/' . $filename, $image);
        return $filename;
    }
}
