<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadImageTrait
{
    /**
     * Upload a file to a specific disk and folder
     */
    public function uploadFile(UploadedFile $file, string $folder, string $disk = 'public'): string
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        return $file->storeAs($folder, $filename, $disk);
    }

    /**
     * Delete a file from a disk
     */
    public function deleteFile(string $path, string $disk = 'public'): bool
    {
        if (Storage::disk($disk)->exists($path)) {
            return Storage::disk($disk)->delete($path);
        }
        return false;
    }
}
