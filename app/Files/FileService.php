<?php

namespace App\Files;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use InvalidArgumentException;
use SplFileInfo;

class FileService
{
    const PUBLIC_PATH = 'public/cdn/';

    private SplFileInfo $value;

    private string $hashName;

    private string $directory;

    public function __construct(SplFileInfo $file, ?string $directory = '')
    {
        $this->value = $file;
        $this->hashName = $this->getHashName();
        $this->directory = self::PUBLIC_PATH.$directory;
        if (! in_array($this->mimeType(), static::acceptedExtensions())) {
            throw new InvalidArgumentException(static::errorMessageMimeType());
        }
    }

    public static function storageDefineDisk(): string
    {
        if (config('app.env') == 'production') {
            return 'spaces';
        }

        return 'public';
    }

    public function value(): SplFileInfo
    {
        return $this->value;
    }

    public static function acceptedExtensions(): array
    {
        return [
            'image/svg+xml',
            'image/jpg',
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/x-ico',
            'application/pdf',
            'application/doc',
            'application/zip',
            'application/x-zip-compressed',
        ];
    }

    public static function acceptedFormats(): string
    {
        return str_replace(
            [
                'image/',
                'application/',
                'video/',
                'audio/',
                'text/',
                'font/',
            ],
            '',
            implode(',', static::acceptedExtensions())
        );
    }

    public function store(): array
    {
        Storage::disk($this->storageDefineDisk())->put(
            $this->directory.$this->hashName(),
            file_get_contents($this->path())
        );

        return [
            'original_name' => $this->fileName(),
            'hash_name' => $this->hashName(),
            'type' => $this->type(),
            'path' => $this->pathByHash($this->hashName()),
        ];
    }

    public function update(?string $oldFileHashName = null): array
    {
        Storage::disk($this->storageDefineDisk())->put(
            $this->directory.$this->hashName(),
            file_get_contents($this->path())
        );

        if ($oldFileHashName) {
            $this->delete($oldFileHashName);
        }

        return [
            'original_name' => $this->fileName(),
            'hash_name' => $this->hashName(),
            'type' => $this->type(),
            'path' => $this->pathByHash($this->hashName()),
        ];
    }

    public function delete(?string $fileHash = null): void
    {
        if (! $fileHash) {
            return;
        }

        Storage::disk(static::storageDefineDisk())->delete("{$this->directory}{$fileHash}");
    }

    public function fileName(): string
    {
        return $this->value->getClientOriginalName() ?? $this->hashName();
    }

    public function hashName(): string
    {
        return $this->hashName;
    }

    private function getHashName(): string
    {
        $hash = Str::random(40);

        return $hash.'.'.$this->type();
    }

    public function mimeType(): string
    {
        return finfo_file(finfo_open(FILEINFO_MIME_TYPE), $this->value->getPathName());
    }

    public function type(): string
    {
        return explode('/', $this->mimeType())[1];
    }

    public function path(): string
    {
        return $this->value->getPathName();
    }

    public static function errorMessageMimeType(): string
    {
        return 'The file extension is invalid. Try to pass an file in the following formats '
            .static::acceptedFormats().'.';
    }

    public function pathByHash(?string $hashName = null): ?string
    {
        if (! $hashName) {
            return null;
        }

        return Storage::disk(static::storageDefineDisk())->url("{$this->directory}{$hashName}");
    }

    public static function deleteByPath(string $directory, string $fileHash): void
    {
        if ($fileHash == '') {
            return;
        }

        $normalized = $directory;
        if ($normalized != '' && ! str_ends_with($normalized, '/')) {
            $normalized .= '/';
        }

        Storage::disk(static::storageDefineDisk())->delete("{$normalized}{$fileHash}");
    }

    public static function deleteByHash(?string $directory, string $fileHash): void
    {
        if ($fileHash == '') {
            return;
        }

        $dir = $directory ?? '';
        if ($dir != '' && ! str_ends_with($dir, '/')) {
            $dir .= '/';
        }

        Storage::disk(static::storageDefineDisk())->delete(self::PUBLIC_PATH.$dir.$fileHash);
    }

    public static function deleteByUrl(string $url): void
    {
        if ($url == '') {
            return;
        }

        $parsedPath = parse_url($url, PHP_URL_PATH) ?? '';
        if ($parsedPath == '') {
            return;

        }

        $hashName = basename($parsedPath);
        if ($hashName == '' || $hashName == '/') {
            return;
        }

        $path = ltrim($parsedPath, '/');
        $prefix = self::PUBLIC_PATH;
        $dir = '';
        if (str_starts_with($path, $prefix)) {
            $relative = substr($path, strlen($prefix));
            $dir = dirname($relative);
            if ($dir == '.' || $dir == '/') {
                $dir = '';
            }
        }

        static::deleteByHash($dir, $hashName);
    }
}
