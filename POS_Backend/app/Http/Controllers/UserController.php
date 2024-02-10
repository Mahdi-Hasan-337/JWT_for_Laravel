<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller {
    public function UserRegistration(Request $request) {
        try {
            User::create([
                'firstname' => $request->input('firstname'),
                'lastname' => $request->input('lastname'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Created Successfully',
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                // 'message' => $e->getMessage(), /// This will be used when we are in development phase to see the error
            ], 200);
        }
    }

    public function UserLogin(Request $request) {
        $count = User::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))
            ->count();

        if ($count == 1) {

            // user login -> JWT token issue
            $token = JWTToken::createToken($request->input('email'));

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully logged in',
                'token' => $token,
            ], 200);

        } else {

            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);

        }
    }

    public function SendOTPCode(Request $request) {
        // try {
        $email = $request->input('email');
        $otp = rand(1000, 9999);

        $count = User::where('email', '=', $email)->count();

        if ($count == 1) {
            // OTP email address
            Mail::to($email)->send(new OTPMail($otp));

            // Update OTP in the database
            User::where('email', '=', $email)->update(['otp' => $otp]);

            return response()->json([
                'status' => 'success',
                'message' => 'OTP sent to your email',
            ], 200);

        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }
        // } catch (Exception $e) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Internal Server Error',
        //     ], 500);
        // }
    }

    public function VerifyOTP(Request $request) {
        $email = $request->input('email');
        $otp = $request->input('otp');

        $count = User::where('email', '=', $email)
            ->where('otp', '=', $otp)
            ->count();

        if ($count == 1) {

            // Update OTP in the database
            User::where('email', '=', $email)->update(['otp' => '0']);

            /// password reset token issue

            $token = JWTToken::createTokenForSetPassword($request->input('email'));

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully OTP verified',
                'token' => $token,
            ], 200);

        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

    }

    public function ResetPassword(Request $request) {
        try {
            $email = $request->header('email');
            $password = $request->input('password');
            User::where('email', $email)->update(['password' => $password]);

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully updated',
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'failed',
            ], 401);
        }
    }
}
