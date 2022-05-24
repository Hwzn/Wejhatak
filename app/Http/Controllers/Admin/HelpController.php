<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Help;
class HelpController extends Controller
{
     public function index()
     {
         $data['helps']=Help::orderby('id','desc')->get();
         return view('dashboard.admin.helps.index')->with($data);
     }

     public function store(Request $request)
     {
        $validator = Validator::make($request->all(),
        [
             'name_ar'=>'required',
             'name_en'=>'required',
             'name_ar.required'=>trans('validation.required'),
             'name_en.required'=>trans('validation.required')         
        ]);

        if ($validator->fails())
        {
        return response()->json(['error'=>$validator->errors()->all()]);

        }

        else {
            $aboutus=Help::create([
              'name'=>['en'=>$request->name_en,'ar'=>$request->name_ar],
            ]);
            if(!is_null($aboutus)) {
              toastr()->success(trans('messages_trans.success'));
              return response()->json(['success'=>'Added new records.']);
            }
  
          }
     }

     public function edit($id)
     {
        $help_data=Help::findorfail($id);
        if($help_data)
        {
          return response()->json($help_data);
        }
     }

     public function update(Request $request)
     {
         // return response($request);
       $validator=Validator::make($request->all(),[
              'name_ar'=>'required|unique:helps,name->ar,'.$request->help_id,
              'name_en'=>'required|unique:helps,name->en,'.$request->help_id,
              'name_ar.required'=>trans('validation.required'),
              'name_en.required'=>trans('validation.required')    
     ]);
     if ($validator->fails())
     {
     return response()->json(['error'=>$validator->errors()->all()]);
     }
     
     else{
       $data=Help::where('id',$request->help_id)->update([
         'name' => ['en' => $request->name_en, 'ar' => $request->name_ar],
       ]);
 
     
       if(!is_null($data))
       {
         toastr()->success(trans('messages_trans.success'));
         return response()->json(['success'=>'Added new records.']);
       }
     }
       
     }

     public function destroy($id)
    {
        $data=Help::where('id',$id)->delete();
        if(!is_null($data))
      {
        toastr()->error(trans('helps_trans.Message_Delete'));
        return response()->json(['success'=>'deleted  success.']);
      }
    }
 
}
