<?php

namespace App\Http\Controllers;

use App\Models\Vlog;
use Illuminate\Http\Request;

class VlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        return view('vlogI');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vlog');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'vlog1' => ['required_without_all:vlog2,vlog3'],
            'vlog2' => ['required_without_all:vlog1,vlog3'],
            'vlog3' => ['required_without_all:vlog2,vlog1']
        ],[
            'name.required'=>'enter Your Name',
            'vlog1.required_without_all'=>'enter at least one vlog',
            'vlog2.required_without_all'=>'enter at least one vlog',
            'vlog3.required_without_all'=>'enter at least one vlog'
        ]);
       
        $vlog = Vlog::create($validation);
        return redirect()->back()->with('success','vlog created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
