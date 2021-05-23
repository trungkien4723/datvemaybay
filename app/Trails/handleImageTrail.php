<?php

namespace App\Traits;


use Intervention\Image\Facades\Image;

trait HandleImageTrait
{
    public function verifyImage($image)
    {
        if ($image && $image->isValid()) {
            return true;
        }
        return false;
    }

    public function saveImage($image, $path)
    {
        if ($this->verifyImage($image)) {
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move($path.$name);
//            Image::make($image)->resize(300, 300)->save($path . $name);
            return $name;
        }
    }

    public function deleteImage($name, $path)
    {
        if (file_exists($path . $name) && $name != 'default.jpg') {
            unlink($path . $name);
        }
    }

    public function updateImage($image, $path, $currentName)
    {
        if ($this->verifyImage($image)) {
            $name = $this->saveimage($image, $path);
            $this->deleteImage($currentName, $path);
            return $name;
        } else {
            return $currentName;
        }
    }

}
