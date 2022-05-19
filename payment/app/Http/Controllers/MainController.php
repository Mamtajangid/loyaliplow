<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Session;
use Redirect;
use App\Models\User;
use App\Models\UserType;

class MainController extends Controller
{
    public function index()
    { 
        $d=auth()->user()->id;
        // dd($d);
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
    //    dd($user);
        return view('index',compact('user'));
    }
    public function success()
    {
        return view('success');
    }

    public function payment(Request $request)
    {
        $input = $request->all();
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {

                $id = $payment->id;
                $amount = $payment->amount;
                $email = $payment->email;
                $contact = $payment->contact;
                $status = $payment->status;

                $payInfo = [
                    'razorpay_payment_id' => $id,
                    'amount' => $amount,
                    'email' => $email,
                    'number' => $contact,
                    'status' => $status
                ];
                $payment1 = Payment::insertGetId($payInfo);
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount' => $payment['amount']));
            } catch (\Exception $e) {
                return  $e->getMessage();
                \Session::put('error', $e->getMessage());
                return redirect()->back();
            }
        }

        \Session::put('success', 'Payment successful');
        return redirect()->back();
    }


}

