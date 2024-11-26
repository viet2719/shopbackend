<?php
namespace App\Services;
use App\Upload;

class FileUploadService
{
    use Upload;
    public function uploadFiles($param, $model)
    {
        if ($param->hasFile('files')) {
            foreach ($param->file('files') as $file) {
                if ($file->isValid()) {
                    $path = $this->uploadFile($file, 'uploads');
                    $model->file()->create([
                        'path' => $path
                    ]);
                }
            }
        }
        return response()->json([
            'error' => 'No files uploaded',
        ], 400);
    }


}
