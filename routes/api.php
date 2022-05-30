<?php

use App\Http\Controllers\Api\AboutUsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommonQuestions;
use App\Http\Controllers\Api\Users\ContactUscontroller;
use App\Http\Controllers\Api\Users\FaviourtTripagentController;
use App\Http\Controllers\Api\Users\HelpRequestController;
use App\Http\Controllers\Api\Users\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'user'],function(){
    Route::get('userhomepage/{lang}',[UserController::class,'userhomepage']);    

});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);

    Route::post('/resendotp', [AuthController::class, 'resendotp']);
    Route::post('/resetpassword', [AuthController::class, 'resetpassword']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);  
    Route::post('Activeuser',[AuthController::class,'Activeuser']);
    Route::post('delete_user/{id}',[AuthController::class,'delete_user']);

   
   
    
    Route::group(['middleware'=>'jwt.verified','prefix'=>'user'],function(){

        //UserDshboard
        Route::post('/updateuser', [UserController::class, 'updateuser']);  
        Route::post('/resetpassword', [UserController::class, 'resetpassword']);  

        // Route::get('getallservices/{lang}',[UserController::class,'getallservices']);    
     
        Route::get('allTourism_tripgents',[UserController::class,'getallTourism_tripgents']);    
        Route::get('gettop4Tourism_tripgents',[UserController::class,'GetTop4Tourism_tripgents']);    
      
        Route::get('alleducationcompany_tripgents',[UserController::class,'alleducationcompany_tripgents']);    
        Route::get('gettop4educationcompany_tripgents',[UserController::class,'gettop4educationcompany_tripgents']);    
        Route::get('getTripgents_byServiceid/{id}',[UserController::class,'getTripgents_byServiceid']);    
        Route::get('getservices_byTripagentid/{lang}/{id}',[UserController::class,'getservices_byTripagentid']);    

        Route::get('tourguides',[UserController::class,'showall_tourguides']); 
        Route::get('showTop4_tourguides',[UserController::class,'showTop4_tourguides']); 
        Route::get('showtourguide_byid/{id}',[UserController::class,'showtourguide_byid']); 
        Route::get('search/{name}',[UserController::class,'allsearch']); 

        Route::get('service_attributes/{id}',[UserController::class,'getservice_attributes']); 

        //help_requests
        Route::post('/send_helprequest',[HelpRequestController::class,'send_helprequest']); 
        Route::get('/showhelp_requests/{lang}/{user_id}',[HelpRequestController::class,'showhelprequests']); 
        
        //Favourite_TripAgent
        Route::get('/UserFavourite_TripAgent/{User_id}',[FaviourtTripagentController::class,'index']);
        Route::get('/UserFavourite_ShowTripAgent/{id}',[FaviourtTripagentController::class,'showtripagent']);
        Route::post('/AddFavourite_TripAgent',[FaviourtTripagentController::class,'store']);
        
    });

});


//Contactus
    Route::post('/send_contactrequest', [ContactUscontroller::class, 'store']);
//aboutus
Route::get('/aboutus/{lang}', [AboutUsController::class, 'index']);

//CommonQuestion
Route::get('/commonquestion/{lang}', [CommonQuestions::class, 'index']);





