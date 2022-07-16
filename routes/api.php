<?php

use App\Http\Controllers\Api\AboutUsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommonQuestions;
use App\Http\Controllers\Api\TermsCondtionsController;
use App\Http\Controllers\Api\Tripagent\HomePageController;
use App\Http\Controllers\Api\Tripagent\PackageController;
use App\Http\Controllers\Api\Tripagent\ProfileController;
use App\Http\Controllers\Api\Tripagent\ServiceController;
use App\Http\Controllers\Api\Tripagent\TripAgentAuthController;
use App\Http\Controllers\Api\Users\BookingController;
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

//Routes For Non User
Route::group(['prefix'=>'user','middleware'=>'api'],function(){
    Route::get('userhomepage/{lang}',[UserController::class,'userhomepage']);    
    Route::get('allTourism_tripgents/{lang}',[UserController::class,'getallTourism_tripgents']);    
    Route::get('alleducationcompany_tripgents/{lang}',[UserController::class,'alleducationcompany_tripgents']);    
    Route::get('get_tripagentbyid/{lang}/{id}',[UserController::class,'get_tripagentbyid']);    

    
    Route::get('tourguides/{lang}',[UserController::class,'showall_tourguides']); 
    Route::get('show_placesTovisits/{lang}',[UserController::class,'show_placesTovisits']); 
    Route::get('viewplacevisit_details/{lang}/{id}',[UserController::class,'viewplacevisit_details']); 

    Route::get('getTripgents_byServiceid/{lang}/{id}',[UserController::class,'getTripgents_byServiceid']);    
    Route::get('getservices_byTripagentid/{lang}/{id}',[UserController::class,'getservices_byTripagentid']);    
    Route::get('showtourguide_byid/{lang}/{id}',[UserController::class,'showtourguide_byid']); 
   
    //for mahmoud
    Route::get('/get_userdata/{userid}',[UserController::class,'getuser']);


    
    Route::post('/send_contactrequest', [ContactUscontroller::class, 'store']);
    Route::get('/aboutus/{lang}', [AboutUsController::class, 'index']);
    Route::get('/commonquestion/{lang}', [CommonQuestions::class, 'index']);
    Route::get('/showtermscondition/{lang}', [UserController::class, 'showtermscondition']);
    Route::get('/showusageploicy/{lang}', [UserController::class, 'showusageploicy']);
    
    Route::get('/showads_slideshow', [UserController::class, 'showads_slideshow']);


    
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
     
        /*
        Route::get('allTourism_tripgents/{lang}',[UserController::class,'getallTourism_tripgents']);    
        Route::get('alleducationcompany_tripgents/{lang}',[UserController::class,'alleducationcompany_tripgents']);    
        Route::get('tourguides/{lang}',[UserController::class,'showall_tourguides']); 

        Route::get('getTripgents_byServiceid/{lang}/{id}',[UserController::class,'getTripgents_byServiceid']);    
        Route::get('getservices_byTripagentid/{lang}/{id}',[UserController::class,'getservices_byTripagentid']);    

        Route::get('showtourguide_byid/{lang}/{id}',[UserController::class,'showtourguide_byid']); 
        Route::get('showPlacesTovisits/{lang}',[UserController::class,'showPlacesTovisits']); 
       */
        Route::get('search/{name}',[UserController::class,'allsearch']); 

        Route::get('service_attributes/{id}',[UserController::class,'getservice_attributes']); 

        //help_requests
        Route::get('/FormHelpRequest/{lang}',[HelpRequestController::class,'FormHelpRequest']); 
        Route::post('/send_helprequest',[HelpRequestController::class,'send_helprequest']); 
        Route::get('/showhelp_requests/{lang}/{user_id}',[HelpRequestController::class,'showhelprequests']); 
        //Favourite_TripAgent
        Route::get('/UserFavourite_TripAgent/{lang}/{User_id}',[FaviourtTripagentController::class,'index']);
        Route::get('/UserFavourite_ShowTripAgent/{lang}/{id}',[FaviourtTripagentController::class,'showtripagent']);
       
        Route::post('/AddFavourite_TripAgent',[FaviourtTripagentController::class,'store']);
        
        //bookingform
        
        Route::get('/bookingform/{lang}/{Tripagent_id}/{Service_id}',[BookingController::class,'bookingform']);
        Route::get('/Tourguide_Consultionform/{lang}/{Trouguide_id}',[BookingController::class,'Tourguide_Consultionform']);

        
        Route::get('/quick_requestform/{lang}',[BookingController::class,'quick_requestform']);

        Route::post('/storebooking',[BookingController::class,'storebooking']);
        Route::post('/storeconsultion_tourguiderequest',[BookingController::class,'storeconsultion_tourguiderequest']);

        Route::get('/getuser_bookingsdeatils/{lang}/{id}',[BookingController::class,'getuserbookings']);
        Route::get('/userbookings/{lang}/{id}/{page}',[BookingController::class,'userbookings']);
        Route::post('/package_filter/{lang}',[BookingController::class,'package_filter']);

        
        //showall_attribute
        Route::get('/showall_attribute/{lang}',[BookingController::class,'showall_attribute']);

        //user notification
        Route::get('/show_notification/{userid}/{lang}/{page}',[UserController::class,'shownotification']);
    });

    Route::get('/aboutus/{lang}', [AboutUsController::class, 'index']);
    Route::get('/commonquestion/{lang}', [CommonQuestions::class, 'index']);
    
    // Route::group([
    //     'prefix'=>'tripagent','namespace'=>'Tripagent'
    // ],function(){
    //     Route::post('/login', [TripAgentAuthController::class, 'login']);
    // });



    //TripAgent
    Route::group([
        'middleware' => ['api','CheckTripagentToken:tripagent-api'],
        'prefix' => 'tripagent',
    ], function ($router) {
        Route::post('/logout',[TripAgentAuthController::class, 'logout'])->name('logout');
        Route::get('/userprofile',[TripAgentAuthController::class, 'userprofile'])->name('userprofile');
        Route::get('/myservices/{lang}',[ServiceController::class, 'myservices']);
        Route::get('/Services_List/{lang}',[ServiceController::class, 'Services_List']);
        Route::post('/Add_Service',[ServiceController::class, 'Add_Service']);
        Route::post('/changestatus',[ServiceController::class, 'changeservice_status']);
        Route::post('/deleteservice',[ServiceController::class, 'deleteservice']);


        //userprofile
        Route::post('/resetpassword',[ProfileController::class, 'resetpassword']);
       //homepage
       Route::get('/HomePage/{lang}',[HomePageController::class, 'index']);
       Route::get('/shownotification/{lang}/{page}',[ProfileController::class, 'shownotification']);

       //Packages
       Route::get('/package_form',[PackageController::class,'package_form']);
       Route::post('/addpackage',[PackageController::class,'addpackage']);
       Route::post('/changepackage_status',[PackageController::class,'change_status']);
       Route::get('/editpackage/{id}',[PackageController::class,'edit']);
       Route::post('/updatepackage/{id}',[PackageController::class,'update']);

       
    });

});

//Tripaentlogin
route::group([
    'middleware'=>'api',
    'prefix' => 'tripagent',
], function ($router) {
    Route::post('/login', [TripAgentAuthController::class, 'login']);
    Route::post('/register', [TripAgentAuthController::class, 'register']);
    Route::post('/Activeuser',[TripAgentAuthController::class, 'Activeuser']);
    Route::post('/resetpassword',[TripAgentAuthController::class, 'resetpassword']);
    Route::post('/resendotp',[TripAgentAuthController::class, 'resendotp']);

    
    
});
 

 



