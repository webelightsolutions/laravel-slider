<?php

function moveAllFiles($requestFiles, $oldPath, $targetPath, $sliderName)
{
    $result = [];
    $files = Storage::disk('public')->files('temp/sliders/');
    
    foreach ($files as $file) {
        $directory = Storage::disk('public')->makeDirectory($sliderName);

        Storage::disk('public')
        ->move($file, $sliderName.'/original/'.basename($file));
    }
    resizeImage($requestFiles, $sliderName.'/small/', 200, 200);
    $result['success'] = "Files have been moved successfully.";
    return $result;
}

function resizeImage($files, $storagePath, $width, $height)
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


function uploadFile($path, $file, $storageName)
{
    $result = [];
    $extension = $file->getClientOriginalExtension();
    $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
    $fileName = cleanString($fileName);
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

function cleanString($string)
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
