<?php

namespace App\Http\Controllers;
use App\Models\vlog;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(request $request){
        $validation->$request->validate([
          
        ]);
        $user=vlog::create($validation);
    }
}
