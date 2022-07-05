<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SelectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class DropDownlistsController extends Controller
{
    public function index()
    {
        $data['SelectTypes']=SelectType::orderby('id','desc')->get();
        return view('dashboard.admin.DropDownLists.index')->with($data);
    }

    public function store(Request $request)
    {
       $validator = Validator::make($request->all(),
       [
            'name'=>'required',
            'name.required'=>trans('validation.required')         
       ]);

       if ($validator->fails())
       {
       return response()->json(['error'=>$validator->errors()->all()]);

       }

       else {
           $SelectType=SelectType::create([
             'name'=>$request->name,
           ]);
           if(!is_null($SelectType)) {
             toastr()->success(trans('messages_trans.success'));
             return response()->json(['success'=>'Added new records.']);
           }
 
         }
    }

    public function edit($id)
    {
       $SelectType=SelectType::findorfail($id);
       if($SelectType)
       {
         return response()->json($SelectType);
       }
    }

    public function update(Request $request)
    {
        // return response($request);
      $validator=Validator::make($request->all(),[
             'name'=>'required|unique:select_types,name,'.$request->select_typeid,
             'name.required'=>trans('validation.required'),
    ]);
    if ($validator->fails())
    {
    return response()->json(['error'=>$validator->errors()->all()]);
    }
    else{
      $data=SelectType::where('id',$request->select_typeid)->update([
        'name' => $request->name,
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
       $data=SelectType::where('id',$id)->delete();
       if(!is_null($data))
     {
       toastr()->error(trans('SelectTypes_trans.Message_Delete'));
       return response()->json(['success'=>'deleted  success.']);
     }
   }

}
