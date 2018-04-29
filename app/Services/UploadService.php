<?php

namespace Muan\Admin\Services;

use Intervention\Image\ImageManagerStatic as Image;
use Storage;

/**
 * Class UploadService
 *
 * @package Muan\Admin\Services
 */
class UploadService
{

    /**
     * Get disk
     *
     * @return mixed
     */
    protected function getDisk()
    {
        $diskName = config('admin.diskname');
        return Storage::disk($diskName);
    }

    /**
     * Upload file
     * @param $file
     * @param string $space
     * @param mixed $resize
     * @return string
     */
    public function upload($file, $space, $resize = null) : string
    {
        $disk = $this->getDisk();

        $path = $disk->putFile($space, $file);

        if ($resize) {
            $this->resize($path, $resize);
        }

        return $path;
    }

    /**
     * Resize image
     *
     * @param string $path
     */
    public function resize($path, $resize)
    {
        $disk = $this->getDisk();
        $image = Image::make($disk->get($path));

        if ($resize['method'] == 'fit') {
            $image->fit($resize['width'] ?? null, $resize['height'] ?? null);
        } elseif ($resize['method'] == 'resize') {
            $image->resize($resize['width'] ?? null, $resize['height'] ?? null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            // TODO: other methods
        }

        $disk->put($path, $image->stream());
    }

    /**
     * Remove file
     *
     * @param  string $fileName
     */
    public function remove(string $fileName)
    {
        $this->getDisk()->delete($fileName);
    }

}
