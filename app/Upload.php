<?php

namespace App;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
trait Upload
{
    public function uploadFile(UploadedFile $file, $folder = null, $disk = 'public', $filename = null): false|string
    {
        $fileName = !is_null($filename) ? $filename : Str::random(10);
        return $file->storeAs(
            $folder,
            $fileName . "." . $file->getClientOriginalExtension(),
            $disk
        );
    }

    public function deleteFile($paths, $disk = 'public'): void
    {
        foreach ($paths as $path) {
            if (Storage::disk($disk)->exists($path)) {
                Storage::disk($disk)->delete($path);
            }
        }
    }
}
