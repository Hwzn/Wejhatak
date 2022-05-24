<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutus=AboutUs::get();
        return view('dashboard.admin.aboutus.index',compact('aboutus'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
             'desc_ar'=>'required',
             'desc_en'=>'required',
             'desc_ar.required'=>trans('validation.required'),
             'desc_en.required'=>trans('validation.required')         
        ]);

        if ($validator->fails())
        {
        return response()->json(['error'=>$validator->errors()->all()]);

        }

        else {
            $aboutus=AboutUs::create([
              'desc' => ['en' => $request->desc_en, 'ar' => $request->desc_ar],
            ]);
            if(!is_null($aboutus)) {
              toastr()->success(trans('messages_trans.success'));
              return response()->json(['success'=>'Added new records.']);
            }
  
          }
    }

    public function edit($id)
    {
      $about_data=AboutUs::findorfail($id);
      if($about_data)
      {
        return response()->json($about_data);
      }
    }


    public function update(Request $request)
    {
        // return response($request);
      $validator=Validator::make($request->all(),[
           'desc_ar'=>'required',
             'desc_en'=>'required',
             'desc_ar.required'=>trans('validation.required'),
             'desc_en.required'=>trans('validation.required')    
    ]);
    if ($validator->fails())
    {
    return response()->json(['error'=>$validator->errors()->all()]);
    }
    
    else{
      $data=AboutUs::where('id',$request->aboutus_id)->update([
        'desc' => ['en' => $request->desc_en, 'ar' => $request->desc_ar],
      ]);

    
      if(!is_null($data))
      {
        toastr()->success(trans('messages_trans.success'));
        return response()->json(['success'=>'Added new records.']);
      }
    }
      
    }


    public function delete($id)
    {
        $data=AboutUs::where('id',$id)->delete();
        if(!is_null($data))
      {
        toastr()->error(trans('Aboutus_trans.Message_Delete'));
        return response()->json(['success'=>'deleted  success.']);
      }
    }


}
