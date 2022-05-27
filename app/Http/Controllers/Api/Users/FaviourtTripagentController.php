<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Models\FaviourtTripAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Api\Trait\ApiResponseTrait;
use App\Models\Tripagent;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class FaviourtTripagentController extends Controller
{
    use ApiResponseTrait;

    public function index($User_id)
    {
      if(FaviourtTripAgent::where('User_id',$User_id)->exists())
      {
        $data=User::select('users.id','users.name')->with('Tripagents')
             ->find($User_id);
         return $this->apiResponse($data,'ok',200);
      }
      else
      {
        return $this->apiResponse('','User Not Found',404);

      }
       
    }

    public function showtripagent($TripAgent_id)
    {

        if(Tripagent::where('id',$TripAgent_id)->exists())
      {
        $data=Tripagent::where('id',$TripAgent_id)->first();
            
         return $this->apiResponse($data,'ok',200);
      }
      else
      {
        return $this->apiResponse('','User Not Found',404);

      }
       
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'User_id' => 'required|exists:users,id',
            'TripAgent_id' => 'required|exists:trip_agents,id',
        ]);

        if ($validator->fails()) 
        {
            return response()->json($validator->errors(), 422);
        }

        $userid=$request->User_id;
        $TripAgent_id=$request->TripAgent_id;
        $favourit_tripag=FaviourtTripAgent::where(function($query) use($userid,$TripAgent_id){
            $query->where('User_id',$userid)
                  ->where('TripAgent_id',$TripAgent_id);
        })->first();

        if(!empty($favourit_tripag))
         {
            return $this->apiResponse("",'Favourit TripAgent Already Exists',405);

         }
        else
        {

            $data=FaviourtTripAgent::create([
                'User_id'=>$request->User_id,
                'TripAgent_id'=>$request->TripAgent_id,
            ]);
    
            if($data):
                return $this->apiResponse($data,'Data Add SuccessFul',200);
            else:
                return $this->apiResponse("",'Error in Save',400);
    
            endif;

        }
      
    
        
    }
}
