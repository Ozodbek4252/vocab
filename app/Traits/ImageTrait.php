<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Image as ImageModel;
use Intervention\Image\Facades\Image;

trait ImageTrait
{
    protected $img;
    protected $width;
    protected $height;
    protected $directory;
    protected $photo_name;
    protected $mime_type;
    protected $imagebleId;
    protected $imageableType;
    protected $extension;

    public function storeImage($imageRequest, $directory, $imageableType, $imagebleId): void
    {
        $this->init($imageRequest, $directory, $imageableType, $imagebleId);

        // save the original image
        $this->storeOriginalImage();

        // reset image (return to backup state)
        $this->img->reset();

        $sizes = ['thumbnail' => 200, 'medium' => 1000];

        foreach ($sizes as $type => $size) {
            // reset image (return to backup state)
            $this->img->reset();

            $this->img
                ->encode($this->extension, 80)
                ->resize($size, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

            // ex: app/public/users/original/yUm0504MCubkWiXNAb9D-2460.jpg
            $path = $this->directory . '/' . $type . '/' . $this->photo_name .
                '-' . $size . '.' . $this->extension;
            $this->img->save(storage_path('app/public/' . $path));

            $imagePath = Storage::path('public/' . $path);
            // Get the size of the image in bytes
            $sizeInBytes = File::size($imagePath);

            $this->createImage($path, $type, $sizeInBytes);
        }
    }

    public function convertToWebP($imageRequest, $directory, $imageableType, $imagebleId, $type = 'original')
    {
        $this->directory = $directory;
        $this->imagebleId = $imagebleId;
        $this->imageableType = $imageableType;
        $this->type = $type;
        $this->photo_name = Str::random(20);
        $this->mime_type = 'image/webp';
        $this->extension = 'webp';

        // Create the directory if it does not exist
        $publicDirectory = storage_path('app/public') . '/' . $this->directory;
        if (!file_exists($publicDirectory)) {
            mkdir($publicDirectory, 0700, true);
        }

        if (function_exists('imagewebp')) {
            // Convert image to WebP format
            $webpImage = Image::make($imageRequest)
                ->encode('webp', 100);

            // Save the WebP image to storage or serve directly to the client
            $webpImagePath = $directory . '/' . $this->photo_name . '.webp';
            Storage::put('public/' . $webpImagePath, $webpImage->stream());

            $imagePath = Storage::path('public/' . $webpImagePath);

            // Get the size of the image in bytes
            $sizeInBytes = File::size($imagePath);

            $this->createImage($webpImagePath, 'original', $sizeInBytes);

            return ['webp_image_url' => $webpImagePath];
        } else {
            return ['error' => 'GD library does not support WebP.'];
        }
    }

    private function init($imageRequest, $directory, $imageableType, $imagebleId)
    {
        $this->directory = $directory;
        $this->imagebleId = $imagebleId;
        $this->imageableType = $imageableType;
        $this->photo_name = Str::random(20);
        $this->mime_type = $imageRequest->getMimeType();
        $this->extension = $imageRequest->getClientOriginalExtension();
        $this->createDirectory();
        $this->width = Image::make($imageRequest)->width();
        $this->height = Image::make($imageRequest)->height();
        $this->img = Image::make($imageRequest);

        // backup status
        $this->img->backup();
    }

    private function storeOriginalImage()
    {
        $this->img->encode($this->extension, 50)->resize($this->width, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $path = $this->directory . '/original/' . $this->photo_name . '.' . $this->extension;
        $this->img->save(storage_path('app/public/' . $path));
        $imagePath = Storage::path('public/' . $path);
        // Get the size of the image in bytes
        $sizeInBytes = File::size($imagePath);

        $this->createImage($path, 'original', $sizeInBytes);
    }

    private function createImage($path, $type, $size)
    {
        ImageModel::create([
            'path' => $path,
            'imageable_id' => $this->imagebleId,
            'imageable_type' => $this->imageableType,
            'type' => $type,
            'size' => $size,
            'mime_type' => $this->mime_type,
            'extension' => $this->extension
        ]);
    }

    private function createDirectory()
    {
        $publicDirectory = storage_path('app/public') . '/' . $this->directory;
        if (!file_exists($publicDirectory)) {
            mkdir($publicDirectory, 0700, true);
        }
        if (!file_exists($publicDirectory . '/original')) {
            mkdir($publicDirectory . '/original', 0700, true);
        }
        if (!file_exists($publicDirectory . '/medium')) {
            mkdir($publicDirectory . '/medium', 0700, true);
        }
        if (!file_exists($publicDirectory . '/thumbnail')) {
            mkdir($publicDirectory . '/thumbnail', 0700, true);
        }
    }
}
