<?php

namespace App\Http\Controllers\Api\Tripagent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tripagent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;

use App\Support\Collection;
use Carbon\Carbon;
use App\Models\UserNotification;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    use ApiResponseTrait;
   //restpassword
public function resetpassword(Request $request)
{
   $user_id=Auth::user()->id;
   $oldpassword=Auth::user()->password;

    $data = Validator::make($request->all(), [
        'current_password' => 'required',
         'new_password'=> ['required','string','min:3','max:10'],
         'password_confirm'=>'required|same:new_password|string|min:3|max:10',

   ]);
   if($data->fails()){
       return response()->json($data->errors(), 400);
   }
    $currentpassword=$request->current_password;
    if(password_verify($currentpassword,$oldpassword))
    {
        $user=DB::table('trip_agents')->where('id',$user_id)->update([
         'password'=>bcrypt($request->new_password),
         'updated_at'=>now(),
       ]);
       return $this->apiResponse("Success",'Password Updated',200);
    }
    else  
    return $this->apiResponse("Error",'Current Pasword Not Correct',400);

}
//resetpassword

public function userprofile()
{
  // return Auth::user(); //get all user data
  // return auth()->user()->id;
   //   return Auth::user()->id;
   $tripagent=Auth::user();
   $urlhost=request()->getHttpHost();
  // $user=auth()->user();
   $user['id']=$tripagent->id;
   $user['name']=$tripagent->name;
   $user['phone']=$tripagent->phone;
   $user['address']=$tripagent->address;
   $user['starnumber']=$tripagent->starnumber;
   $user['evaulation']=$tripagent->evaulation;
   $user['Agency_id']=$tripagent->Agency_id;
   $user['Agency_name']=$tripagent->Agency->name;
   $user['Countries']=json_decode($tripagent->Countries);
   $user['Commercial_RegistrationNo']=$tripagent->Commercial_RegistrationNo;
   $user['CommercialRegistration_ExpiryDate']=$tripagent->CommercialRegistration_ExpiryDate;
   $user['license_number']=$tripagent->license_number;
   $user['license_expiry_date']=$tripagent->license_expiry_date;
   $user['status']=$tripagent->status;

   // $user['photo']="$urlhost/public/assets/uploads/Profile/UserProfile/".auth()->user()->photo;
   $photo=$tripagent->photo;
   if(!$photo==null)
   {
     $user['photo']="$urlhost/public/assets/uploads/Profile/TripAgent/".$tripagent->photo;
   }
   else
   {
       $user['photo']="$urlhost/public/assets/uploads/Profile/TripAgent/".'defaultimage.jpg';
   }
   $photo_profile=$tripagent->profile_photo;
   if(!$photo_profile==null)
   {
     $user['photo_profile']="$urlhost/public/assets/uploads/Profile/TripAgent/profile/".$tripagent->profile_photo;
   }
   else
   {
       $user['photo_profile']="$urlhost/public/assets/uploads/Profile/TripAgent/profile/".'defaultimage.jpg';
   }
   $user['verified_at']=$tripagent->verified_at;
   $user['created_at']=$tripagent->created_at;
   $user['updated_at']=$tripagent->updated_at;
   return response()->json($user);
}
  public function updateuser(Request $request)
  {
      $currentuser=auth()->user();
     //return response($currentuser);
    $data = Validator::make($request->all(), [
      'name' => 'required|string|max:255|',
      'phone' => 'required|string|unique:trip_agents,phone,'.$currentuser->id,
      //  'password' => ['required', 'confirmed', Rules\Password::defaults()],
       'photo'=>'image|mimes:jpg,png,jpeg,gif,svg',
 ]);
 if($data->fails()){
     return response()->json($data->errors()->toJson(), 400);
 }
 try{
    
    DB::beginTransaction();
    // $image=$user->photo;
  //$currentuser=User::findorfail($request->user_id);
    $image=$currentuser->photo;
       //return response($image);

     if($request->hasfile('photo')) 
     {
         //هشيل الصورة الديمة
         $path='public/assets/uploads/Profile/TripAgent/'.$image;
         if(File::exists($path))
          {
              File::delete($path);
          }  
        
          $file=$request->file('photo');
          $ext=$file->getClientOriginalExtension();
          $filename=time().'.'.$ext;
          $file->move('public/assets/uploads/Profile/TripAgent',$filename);
          $image=$filename;
     }
 
     $user=Tripagent::where('id',$currentuser->id)->update([
         'name'=>$request->name,
         'phone'=>$request->phone,
         'verified_at'=>$currentuser->verified_at,
         'photo'=>$image,
     ]);

     DB::commit();
     return response()->json([
                 'message' => 'User successfully Updated',
                 'user' => $user
             ], 201);
                 
 
 }
 catch(\Exception $ex){
     DB::rollBack();
     return response()->json([
         'message' => $ex,
         'user' => 'Error in update'
     ], 404);
 }

  }
}
