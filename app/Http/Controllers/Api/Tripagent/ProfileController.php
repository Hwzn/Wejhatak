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
public function shownotification($lang,$page)
{
 $lang=strtolower($lang);
 $today=Carbon::now();
 $tripagent_id=Auth::user()->id;
 $oldnotification=UserNotification::where('tripagent_id',$tripagent_id)
 ->where('expired_at','<=',$today)  
 ->delete();

 $results=UserNotification::select('id','tripagent_id','title',"body->$lang as message_content",'expired_at')
     ->where('tripagent_id',$tripagent_id)
     ->where('expired_at','>=',$today)  
   ->get();

   $user_notificaion = (new Collection($results))->paginate(10,0,$page);
   if(!empty($user_notificaion->count()>0))  
   {
     return $this->apiResponse($results,'ok',200);
   }    
    else{
  return $this->apiResponse('','No notificaion found',404);

 }
}
  
}
