<?php
namespace App\Http\Traits;
use App\Models\image;

trait ImageTraits{
  
    public function index() {
        $image = Image::all();
        return view('image',compact('image'));
    }
}