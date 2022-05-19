<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\UserType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = UserType::select(
            "user_type.id",
            "user_type.user_type",
            "users.name as name",
            "users.email as email",
            "users.password as password"
        )
            ->leftJoin("users", "users.id", "=", "user_type.user_id")
            ->get();

        if (!empty($users)) {
            $Json['data'] = $users;
            $Json['success'] = 1;
            $Json['status'] = 200;
            $Json['message'] = 'Data Available !';
            return response()->json($Json);
        } else {
            $Json['success'] = 0;
            $Json['status'] = 200;
            $Json['message'] = 'Data Not Available!';
            return response()->json($Json);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_type' => 'required',
            'user_id' => 'required|integer|regex:/^[-0-9\+]+$/',
        ], [
            'user_type.required' => 'Select Your  User Type !',
            'user_id.required' => 'Enter User Id'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            $result = UserType::create($request->all());
            $Json['data'] = $result;
            $Json['success'] = 1;
            $Json['status'] = 200;
            $Json['message'] = 'data created succssfully!';
            return response()->json($Json);
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
        $users = UserType::select(
            "user_type.id",
            "user_type.user_type as type",
            "users.name as name",
            "users.email as email",
            "users.password as password")
            ->where('user_type.id', $id)
            ->Join("users", "users.id", "=", "user_type.user_id")
            ->get();
      
        if  ($users->isNotEmpty()) {

            $Json['data'] = $users;
            $Json['success'] = 1;
            $Json['status'] = 200;
            $Json['message'] = 'User Data Availbale!';
            return response()->json($Json);

        } else {
            $Json['success'] = 0;
            $Json['status'] = 200;
            $Json['message'] = 'Id Not Exists!';
            return response()->json($Json);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
    
        $result = UserType::where('id', $id)->get();
        if ($result->isNotEmpty()) {

            $validator = Validator::make($request->all(), [
                'user_type' => 'required'
            ], [
                'user_type.required' => 'Select Your  User Type!',
            ]);
            if ($validator->fails()) {
                return $validator->errors();
            } else {
                $result = UserType::where('id', $id)->update($request->all());

                $users = UserType::select(
                    "user_type.id",
                    "user_type.user_type",
                    "users.name as name",
                    "users.email as email",
                    "users.password as password"
                )
                    ->where('user_type.id', $id)
                    ->leftJoin("users", "users.id", "=", "user_type.user_id")
                    ->get();

                $Json['data'] = $users;
                $Json['success'] = 1;
                $Json['status'] = 200;
                $Json['message'] = 'data updated succssfully!';
                return response()->json($Json);
            }

        } else {
            $Json['success'] = 0;
            $Json['status'] = 200;
            $Json['message'] = 'id not exists!';
            return response()->json($Json);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $id1 = UserType::where('id', $id)->get('id');
        
        if ($id1->isNotEmpty()) {
            UserType::where('id', $id)->delete();
            $Json['success'] = 1;
            $Json['status'] = 200;
            $Json['message'] = 'data deleted succssfully!';
            return response()->json($Json);
        } else {
            $Json['success'] = 0;
            $Json['status'] = 200;
            $Json['message'] = 'Id Not Exist!';
            return response()->json($Json);
        }
    }
}
