<?php

namespace App\Http\Controllers;

use App\Models\All;
use Illuminate\Http\Request;

class SelController extends Controller
{   
    public function index(){
        $all=All::get();
           return view('',compact('all'));
    }
}

