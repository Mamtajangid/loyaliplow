<?php

namespace App\Http\Controllers\API;

use App\Models\Image;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function getAllImage(Request $request)
    {
        if (!empty($request->get('user_type'))) {
            $type = $request->user_type;
            if ($type == 'Admin') {
                $images = Image::select(
                    "images.id",
                    "users.name as name",
                    "users.email as email",
                    "users.password as password",
                    "user_type.user_type as type",
                    "images.image"
                )
                    ->Join("users", "users.id", "=", "images.Image_id")
                    ->Join("user_type", "users.id", "=", "user_type.User_id")
                    ->get()
                    ->map(function ($images, $key) {
                        return [
                            'id' => $images->id,
                            'name' => $images->name,
                            'email' => $images->email,
                            'password' => $images->password,
                            'type' => $images->type,
                            'images' => asset('public/uploads/user-profile/' . $images->image)
                        ];
                    });
                if ($images->isNotEmpty()) {

                    $Result['data'] = $images;
                    $Result['success'] = 1;
                    $Result['status'] = 200;
                    $Result['message'] = 'Data Available !';
                    return response()->json($Result);
                } else {
                    $result['success'] = 0;
                    $result['status'] = 200;
                    $result['message'] = 'Data Not Available!';
                    return response()->json($result);
                }
            } else {
                $secc['success'] = 0;
                $secc['status'] = 200;
                $secc['message'] = 'You Dont Have Permission!';
                return response()->json($secc);
            }
        } else {
            $sec['success'] = 0;
            $sec['status'] = 200;
            $sec['message'] = 'Please Enter A User Type!';
            return response()->json($sec);
        }
    }

    public function getImageId(Request $request)
    {
        $t = $request->all();
        if (!empty($t)) {

            $type = $request->user_type;

            if ($type == 'Admin') {

                $result = Image::where('id', $request->id)->get();

                if ($result->isNotEmpty()) {

                    $validator = Validator::make($request->all(), [
                        'id' => 'required|integer|regex:/^[-0-9\+]+$/',
                    ], [
                        'id.required' => 'id must be integer !',
                    ]);

                    if ($validator->fails()) {
                        return $validator->errors();
                    } else {

                        $i = Image::where('images.id', $request->id)->get('image');
                        $image = $i[0]->image;

                        $images = Image::select(
                            "images.id",
                            "images.image",
                            "users.name as name",
                            "users.email as email",
                            "users.password as password",
                            "user_type.user_type as type",
                        )
                            ->Join("users", "users.id", "=", "images.Image_id")
                            ->Join("user_type", "users.id", "=", "user_type.User_id")
                            ->where('images.id', $request->id)
                            ->get()->each(function ($query) use ($image) {
                                $query->image = asset('public/uploads/user-profile/' . $image);
                                return $query;
                            });

                        $R['data'] = $images;
                        $R['success'] = 1;
                        $R['status'] = 200;
                        $R['message'] = 'Data Available !';
                        return response()->json($R);
                    }
                } else {
                    $resu['success'] = 0;
                    $resu['status'] = 200;
                    $resu['message'] = 'Please Enter A Valid Id!';
                    return response()->json($resu);
                }
            } else {
                $re['success'] = 0;
                $re['status'] = 200;
                $re['message'] = 'You Dont Have Permission!';
                return response()->json($re);
            }
        } else {
            $er['success'] = 0;
            $er['status'] = 200;
            $er['message'] = 'Please Enter A User Type!';
            return response()->json($er);
        }
    }

    public function postImages(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'image_id' => 'required|integer|regex:/^[-0-9\+]+$/',
        ], [
            'image.required' => 'Select Your  Image !',
            'image_id.required' => 'Enter Image Id'
        ]);

        if ($validator->fails()) {
            return $validator->errors();
        } else {
            
            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = time() . '-' . $request->file('image')->getClientOriginalName();
                $file->move(public_path('/uploads/user-profile/'), $filename);
                $data['image'] = $filename;
            }
            $data['image_id'] = $request->image_id;

            $result = Image::create($data);
            $Json['success'] = 1;
            $Json['status'] = 200;
            $Json['message'] = 'data created succssfully!';
            return response()->json($Json);
        }
    }


    public function updateImage(Request $request)
    {
        if (!empty($request->all())) {

            $id = Image::where('id', $request->id)->get();

            if ($id->isNotEmpty()) {

                $validator = Validator::make($request->all(), [
                    'id' => 'required|integer|regex:/^[-0-9\+]+$/',
                    'image' => 'required',
                    'image_id' => 'required|integer|regex:/^[-0-9\+]+$/',
                ], [
                    'image.required' => 'Select Your  Image !',
                    'image_id.required' => 'Enter Image Id',
                    'id.required' => 'Enter Id'
                ]);

                if ($validator->fails()) {
                    return $validator->errors();
                } else {

                    if ($request->file('image')) {
                        $file = $request->file('image');
                        $filename = time() . '-' . $request->file('image')->getClientOriginalName();
                        $file->move(public_path('/uploads/user-profile/'), $filename);
                        $data['image'] = $filename;
                    }
                    $data['image_id'] = $request->image_id;
                    Image::where('id', $request->id)->update($data);

                    $image = 'public/uploads/user-profile/' . $id[0]->image;
                    Unlink($image);

                    $Json['success'] = 1;
                    $Json['status'] = 200;
                    $Json['message'] = 'data updated succssfully!';
                    return response()->json($Json);
                }
            } else {
                $Json['success'] = 0;
                $Json['status'] = 200;
                $Json['message'] = 'Id Not Exists!';
                return response()->json($Json);
            }
        } else {
            $Json['success'] = 0;
            $Json['status'] = 200;
            $Json['message'] = 'Please Enter A Id!';
            return response()->json($Json);
        }
    }


    public function deleteImageId(Request $request)
    {
        $i = $request->all();

        if (!empty($i)) {

            $id1 = Image::where('id', $request->id)->get('id');
            if ($id1->isNotEmpty()) {

                $id = Image::where('id', $request->id)->get();
                if (Image::exists($id)) {

                    $validator = Validator::make($request->all(), [
                        'id' => 'required|integer|regex:/^[-0-9\+]+$/',
                    ], [
                        'id.required' => 'Enter Id'
                    ]);

                    if ($validator->fails()) {
                        return $validator->errors();
                    } else {

                        $image = 'public/uploads/user-profile/' . $id[0]->image;
                        Unlink($image);
                    }
                    Image::where('id', $request->id)->delete();

                    $Json['success'] = 1;
                    $Json['status'] = 200;
                    $Json['message'] = 'data deleted succssfully!';
                    return response()->json($Json);
                }
            } else {
                $Json['success'] = 0;
                $Json['status'] = 200;
                $Json['message'] = 'Id Not Exist!';
                return response()->json($Json);
            }
        } else {
            $Json['success'] = 0;
            $Json['status'] = 200;
            $Json['message'] = 'Please Enter A  Id!';
            return response()->json($Json);
        }
    }
}
