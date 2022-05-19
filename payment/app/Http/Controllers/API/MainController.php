<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Models\Payment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function getAllPayment()
    {
        $Result = Payment::get();
        if ($Result->isNotEmpty()) {
            $Json['data'] = $Result;
            $Json['success'] = 1;
            $Json['status'] = 200;
            $Json['message'] = 'Data Available Here!';
            return response()->json($Json);
        } else {
            $Json['success'] = 0;
            $Json['status'] = 200;
            $Json['message'] = 'No Data Available Here!';
            return response()->json($Json);
        }
    }


    public function updatePayment(Request $request)
    {
        $r = $request->all();
        if (!empty($r)) {

            $id = Payment::where('id', $request->id)->get();
            if ($id->isNotEmpty()) {

                $validator = Validator::make($request->all(), [
                    'id'=>'required|integer|regex:/^[-0-9\+]+$/',
                    'amount' => 'required|numeric',
                    'email' => 'required|email|max:255|unique:users',
                    'number' => 'required|min:11|numeric',
                ], [
                    'id.required' => 'id must be integer !',
                    'amount.required' => 'Select Your Amount !',
                    'email.required' =>  'Select Your Email !',
                    'number.required' => 'Select Your Number !',
                ]);

                if ($validator->fails()) {
                    return $validator->errors();
                } else { 
                    $Result = Payment::where('id', $id)->update($request->all());
                    
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
            $Json['message'] = 'Please Enter Id!';
            return response()->json($Json);
        }
    }

    public function deletePaymentId(Request $request)
    {
        // dd($request->all());
        $r = $request->all();

        if (!empty($r)) {
            $id1 = Payment::where('id', $request->id)->get('id');

            if ($id1->isNotEmpty()) {

                $validator = Validator::make($request->all(), [
                    'id' => 'required|integer|regex:/^[-0-9\+]+$/',
                ], [
                    'id.required' => 'id must be integer !',
                ]);
                if ($validator->fails()) {
                    return $validator->errors();
                } else {

                    $req = Payment::where('id', $request->id)->delete();
                    
                    $Json['success'] = 1;
                    $Json['status'] = 200;
                    $Json['message'] = 'data deleted succssfully!';
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
            $Json['message'] = 'Please  Enter A Id!';
            return response()->json($Json);
        }
    }
}
