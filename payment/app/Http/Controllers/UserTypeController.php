<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Response;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d = auth()->user()->id;
        $user = User::select(
            "users.id",
            "users.name",
            "users.email",
            "users.password",
            "user_type.user_type as type",
        )
            ->Join("user_type", "user_type.id", "=", "users.user_type")
            ->where('users.id', $d)
            ->get();
        
        return view('/usertype',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::select(
            "users.id",
            "users.name",
            "users.email",
            "users.password",
            "user_type.user_type as type",
        )
            ->Join("user_type", "user_type.id", "=", "users.user_type")
            ->get();

            
      
        return view('/usertypelist',compact('user'));
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
                'user_type' => 'required',
            ], [
                'user_type.required' => 'Enter User Type !',
            ]);
            $res = UserType::create($validation);

            if ($res) {
                return redirect()->route('pay.with.razorpay');
            } else {
                return back();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $d = auth()->user()->id;
        $user = User::select(
            "users.id",
            "users.name",
            "users.email",
            "users.password",
            "user_type.user_type as type",
        )
            ->Join("user_type", "user_type.id", "=", "users.user_type")
            ->where('users.id', $d)
            ->get();
        return view('/typeedit',compact('user'));
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
        $validation = $request->validate([
            'user_type' => 'required',
        ], [
            'user_type.required' => 'Enter User Type !',
        ]);
        $res = UserType::where('id',$id)->update($validation);

        if ($res) {
            return view('/usertypelist');
        } else {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id', $id)->delete();
        return Response::json($user);
    }
}
