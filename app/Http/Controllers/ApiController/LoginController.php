<?php

namespace App\Http\Controllers\ApiController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Log;


use App\Models\temp_otp;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'mobile' => 'required'
        ]);

        $user_check = User::where('mobile', $request->mobile)->first();

        if(empty($user_check)){
            $temp_otp=temp_otp::find($request->mobile);
            if(!empty($temp_otp)){

                    if( $request->otp==$temp_otp->otp){
                        $user = new User([
                            'mobile' => $request->mobile,
                            'otp' => rand(1000,9999)
                        ]);
                        $user->save();

                        $temp_otp->delete();

                        $accessToken = $user->createToken('authToken')->accessToken;

                        return response()->json([
                            'message' => 'Successfully created user!',
                            'user' => $user,
                            'access_token' => $accessToken
                        ], 201);

                    }

            }

        }

        if(!empty($user_check)){
            $user  = User::where([['mobile','=',request('mobile')],['otp','=',request('otp')]])->first();
            if($user){
                Auth::login($user, true);
                User::where('mobile','=',$request->mobile)->update(['otp' => rand(1000,9999)]);

                $user = $request->user();
                $tokenResult = $user->createToken('Personal Access Token');
                $token = $tokenResult->token;
                if ($request->remember_me)
                    $token->expires_at = Carbon::now()->addWeeks(1);
                $token->save();
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

    // public function signup(Request $request)
    // {

    //      // $user = User::where('mobile','=',$request->mobile)->update(['otp' => $otp]);
    //     // send otp to mobile no using sms api
    //    $temp_otp=temp_otp::find($request->mobile);
    //    if(!empty($temp_otp)){

    //         if( $request->otp==$temp_otp->otp){
    //             $user = new User([
    //                 'mobile' => $request->mobile,
    //                 'otp' => $request->otp
    //             ]);
    //             $user->save();

    //             $temp_otp->delete();

    //             $accessToken = $user->createToken('authToken')->accessToken;

    //             return response()->json([
    //                 'message' => 'Successfully created user!',
    //                 'user' => $user,
    //                 'access_token' => $accessToken
    //             ], 201);

    //         }

    //    }

    // }



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

        $user_check = User::where('mobile', $request->mobile)->first();

        if(!empty($user_check)){
            $user = User::where('mobile','=',$request->mobile)->update(['otp' => $otp]);
            return response()->json(['message' => 'Otp sent to existing user','otp'=>$otp],200);
        }

        if(empty($user_check)){
             // send otp to mobile no using sms api
            $temp_otp=temp_otp::find($request->mobile);
            if(!empty($temp_otp)){
                    $temp_otp->delete();
            }
            $data = new temp_otp;
            $data->mobile = $request->mobile;
            $data->otp = $otp;
            $data->save();

            return response()->json(['message' => 'Otp sent','otp'=>$otp],200);

        }



    }
}
