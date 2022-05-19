<?php

namespace App\Http\Controllers;
use App\Models\Custom;
use Illuminate\Http\Request;

class CustomValRuleController extends Controller
{
    public function customValiRule()
    {
        return view('customRuleVali');
    }
    public function customValiRulePost(Request $request)
    {
        $this->validate($request, [
            // 'title1' => 'required|is_even_string|double_condition',
            // 'title2' => 'required|is_less_then|double_condition',
             'title1' => 'required|double_condition',
            'title2' => 'required|double_condition',
        ]);

        print_r('done');
    }
}
