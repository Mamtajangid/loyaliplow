<?php

namespace App\Http\Controllers;
use App\Models\All;
use Illuminate\Http\Request;

class YourModelNameController extends Controller
{
   public function in(){
       $a=All::get();
        dd($a);
   }

}
