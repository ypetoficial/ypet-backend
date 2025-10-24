<?php

namespace App\Domains\Files;

use App\Files\FileService;
use Illuminate\Http\UploadedFile;

class FilesService
{
    public function processImage(UploadedFile|string $image, ?string $path = ''): string
    {
        if (is_string($image)) {
            return $image;
        }

        return $this->generateImageUrl($image, $path);
    }

    private function generateImageUrl(UploadedFile $image, ?string $path = ''): string
    {
        $fileService = new FileService($image, $path);
        $storedImage = $fileService->store();

        if (app()->environment('production') || app()->environment('staging')) {
            return $storedImage['path'];
        }

        return $storedImage['path'];
    }

    public function delete(string $imageUrl): void
    {
        FileService::deleteByUrl($imageUrl);
    }
}
