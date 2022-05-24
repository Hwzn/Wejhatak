<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ContactUscontroller extends Controller
{
    //
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:60|min:3',
            'phone' => 'required|max:14|min:9',
            'message'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data=ContactUs::create($request->all());
        if($data)
        {
            return response()->json([
                        'message' => 'Data  Send Successfully',
                        'data' => $data
                    ], 201);
        }
        else
        {
            return response()->json([
                'message' => 'Faild Send Data',
                'data' => ''
            ], 405);
        }

    }
}
