<?php
namespace App\Http\Services;
use App\Models\User_verfication;
use App\Models\User;
use Request;
use Illuminate\Support\Facades\Auth;

use Twilio\Rest\Client;

class SMSServices
{

    public function setVerficationCode($data)
    {
        $otpcode=mt_rand(1000,9999);
        $data['otpcode']=$otpcode;
        User_verfication::where(['user_id'=>$data['user_id']])->delete();
        return User_verfication::create($data);
		//هيبقي جيلك من $data>>user_id,oto_code
    }

    public function checkOtpCode($code,$user_id)
    {
        // if(Auth::guard()->check())
        // {
            $verificationdata=User_verfication::where('user_id',$user_id)->first();
           if($verificationdata->otpcode==$code)
           {
               User::where('id',$user_id)->update([
                   'verified_at'=>now(),
               ]);
               return true;
           }
           else
           {
               return false;
           }
        // }
        
    }

   public function removeOtpCode($code)
    {
        User_verfication::where('otpcode',$code)->delete();
        
    }

    public function getSMSVerifyMessageByAppName($code)
    {
        $message1="Your Verifivation Code for your account ";
        return $message1.$code;
    }

    public function reset_password($code)
    {
        $verificationdata=User_verfication::where('otpcode',$code)->first();
           if($verificationdata)
           {
              
               return true;
           }
           else
           {
               return false;
           }
        }
        
        public function sendSms($phone,$message)
        {
           
            try{
                       $sid= getenv("TWILIO_SID");
                       $token= getenv("TWILIO_TOKEN");
                       $twilio_from= getenv("TWILIO_FROM");

                    //    $reciveNumber=$phone;
                     // dd($phone);

                       $client = new Client($sid, $token);
                    //    $validation_request = $client->validationRequests
                    //    ->create($phone, // phoneNumber
                    //             ["friendlyName" => "My Home Phone Number"]
                    //    );

                       $client->messages->create($phone, // to
                                         [
                                             "body" => $message,
                                             "from" => $twilio_from
                                         ]
                                );
                     if($client)
                     {
                         return true;
                     }
            }
            catch(\Exception $ex)
            {
              return false;
            }
        }
        
    }

  
