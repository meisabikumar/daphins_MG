<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Log;

use App\Models\temp_user;

use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'mobile' => 'required'
        ]);

        //Check user already exist or not
        $user = User::where('mobile', $request->mobile)->first();

        //Check user exist in temporary table
        // $temp_user = temp_otp::where('mobile', $request->mobile)->first();
        $temp_user=temp_user::find($request->mobile);

        if(!$temp_user && !$user ){
            return "user not exist";
        }

        //If Not exist in permanent Table but exist in temporary table
        if(empty($user) && !empty($temp_user)){

            if( $request->otp!=$temp_user->otp){
                return response()->json(['error' =>"Wrong OTP"],400);
            }

            //verify OTP sent from user == OTP send to user mobile and stored in temporary table
            if( $request->otp==$temp_user->otp){

                //Create user and store to Database
                $data = new User([
                    'mobile' => $request->mobile,
                    //populate the OTP field so that user can not login through Old OTP
                    'otp' => rand(1000,9999)
                ]);
                $data->save();

                //delete The user from Temprory Table
                $temp_user->delete();

                //Create Token
                $accessToken = $data->createToken('authToken')->accessToken;

                //send Response
                return response()->json([
                    'message' => 'Successfully created user!',
                    'user' => $data,
                    'access_token' => $accessToken
                ], 201);

            }

        }

        //If user already exist
        if(!empty($user)){

            //search the user and verfity OTP
            $user  = User::where([['mobile','=',request('mobile')],['otp','=',request('otp')]])->first();

            //if OTP not verfied
            if (!$user) {
                return response()->json(['error' =>"Wrong OTP"],400);
            }

            //if OTP verfied
            if($user){

                //Authenticate User
                Auth::login($user, true);

                //Populate OTP filed with random number so that user can not login with old OTP
                User::where('mobile','=',$request->mobile)->update(['otp' => rand(1000,9999)]);

                $user = $request->user();
                $tokenResult = $user->createToken('Personal Access Token');
                $token = $tokenResult->token;
                if ($request->remember_me)
                    $token->expires_at = Carbon::now()->addWeeks(1);
                $token->save();

                //Send OTP
                return response()->json([
                    'access_token' => $tokenResult->accessToken,
                    'user' => $user,
                    'token_type' => 'Bearer',
                    'expires_at' => Carbon::parse(
                        $tokenResult->token->expires_at
                    )->toDateTimeString()
                ]);
            }

        }
    }


    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }


    public function sendOtp(Request $request){
        $otp = rand(1000,9999);
        Log::info("otp = ".$otp);

        //---------- Twillo Credenttials ---------//
        $accountSid = config('app.twilio')['TWILIO_ACCOUNT_SID'];
        $authToken  = config('app.twilio')['TWILIO_AUTH_TOKEN'];
        //---------- Twillo Credenttials ---------//

        //Initialize Twillo client to send OTP
        $client = new Client($accountSid, $authToken);

        //Check user already exist or not
        $user = User::where('mobile', $request->mobile)->first();

        //If user Not exist
        if(empty($user)){

            //Delete Old temprory user from database if exist
            $temp_user=temp_user::find($request->mobile);
            if(!empty($temp_user)){
                    $temp_user->delete();
            }

            //Store the New temprory user to temporary Tabe for later OTP verification
            $data = new temp_user;
            $data->mobile = $request->mobile;
            $data->otp = $otp;
            $data->save();

            //Send OTP using Twillo to user mobile number
            try{
                // Use the client to do fun stuff like send text messages!
                 $client->messages->create(
                        // the number you'd like to send the message to
                        $request->mobile,
                    array(
                            // A Twilio phone number you purchased at twilio.com/console
                            'from' => '+13144085974',
                            // the body of the text message you'd like to send
                            'body' => 'Your OTP : '.$otp
                        )
                    );

                return response()->json(['sucess' =>"OTP sent to new user"],200);
            }
            catch (Exception $e)
            {
                // echo "Error: " . $e->getMessage();
                return response()->json(['error' => $e->getMessage()],400);
            }

        }


        //If user alredy exist
        if(!empty($user)){

            //Store the New OTP to existing User Tabe for later OTP verification
            $user = User::where('mobile','=',$request->mobile)->update(['otp' => $otp]);

            //Send OTP using Twillo to user mobile number
            try{
                // Use the client to do fun stuff like send text messages!
                 $client->messages->create(
                        // the number you'd like to send the message to
                        $request->mobile,
                    array(
                            // A Twilio phone number you purchased at twilio.com/console
                            'from' => '+13144085974',
                            // the body of the text message you'd like to send
                            'body' => 'Your OTP : '.$otp
                        )
                    );

                return response()->json(['sucess' =>"OTP sent to existing user"],200);
            }
            catch (Exception $e)
            {
                // echo "Error: " . $e->getMessage();
                return response()->json(['error' => $e->getMessage()],400);
            }

        }

    }
}
