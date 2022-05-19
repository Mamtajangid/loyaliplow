<?php

namespace App\Observers;
use App\Models\Image;

class ImageObserver
{
    public function creating(Image $Image)
    {
        $Image->image = \Str::slug($Image->image);
    }
 
    public function created(Image $Image)
    {
        $Image->image_id = $Image->image_id;
        $Image->save();
    }
}
