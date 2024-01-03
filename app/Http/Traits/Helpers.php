<?php

namespace app\Http\Traits;

trait Helpers
{
    public function storageImage($requeste)
    {
        $newImageName = uniqid() . '-' . $requeste->title . $requeste->image->extension();
        return $requeste->image->move(public_path('image'), $newImageName);
    }

}
