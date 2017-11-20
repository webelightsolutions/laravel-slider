<?php

namespace Webelightdev\LaravelSlider\Helpers;

use Webelightdev\LaravelSlider\Helpers\IOHelpers;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class EloquentHelpers
{
    public static function moveAllFiles($requestFiles, $oldPath, $targetPath, $sliderName)
    {
        $result = [];
        $files = Storage::disk('public')->files('temp/sliders/');
    
        foreach ($files as $file) {
            $directory = Storage::disk('public')->makeDirectory($sliderName);

            Storage::disk('public')
            ->move($file, $sliderName.'/original/'.basename($file));
        }
        EloquentHelpers::resizeImage($requestFiles, $sliderName.'/small/', 200, 200);
        $result['success'] = "Files have been moved successfully.";
        return $result;
    }

    public static function resizeImage($files, $storagePath, $width, $height)
    {
        foreach ($files as $file) {
            $directory = Storage::disk('public')->makeDirectory($storagePath);
            $image = Image::make($file);
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
            Storage::disk('public')->put($storagePath.'/'.$file->getClientOriginalName(), $image);
        }
    }


    public static function uploadFile($path, $file, $storageName)
    {
        $result = [];
        $extension = $file->getClientOriginalExtension();
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = IOHelpers::cleanString($fileName);
        $fileName = time().'_'.$fileName;
        $finalFileName = $path.$fileName.'.'.$extension;
        Storage::disk($storageName)->put($finalFileName, File::get($file));
        $exists = Storage::disk($storageName)->exists($finalFileName);
        if ($exists) {
            $result['success'] = 'File has been uploaded successfully.';
        } else {
            $result['error'] = 'File upload failed.';
        }
        $result['fileName'] = $fileName.'.'.$extension;
        $result['mime'] = $file->getClientMimeType();
        $result['fileExtension'] = $extension;
        $result['slug'] = str_slug(str_random(10));
        $result['fileLocation'] = $path;
        return $result;
    }
}
