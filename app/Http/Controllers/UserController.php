<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller {

    /// Register
    public function UserRegistration(Request $request) {
        try {
            User::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'User Registration Successfully',
            ], 200);

        } catch (Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 401);

        }
    }

    /// Login
    function UserLogin(Request $request) {
        try {
            $email = $request->input('email');
            $password = $request->input('password');

            $count = User::where('email', '=', $email)
                ->where('password', '=', $password)
                ->select('id')
                ->first();

            $id = $count->id;

            if ($count !== null) {

                $token = JWTToken::CreateToken($request->input('email'), $id);

                return response()->json([
                    'status' => 'success',
                    'message' => 'User Login Successful',
                ], 200)->cookie('token', $token, time() + 60 * 24 * 30);

            } else {

                return response()->json([
                    'status' => 'error',
                    'message' => 'unauthorized',
                ], 401);

            }
        } catch (Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 401);

        }

    }

    /// OTP email
    function SendOTP(Request $request) {
        try {
            $email = $request->input('email');
            $otp = rand(10000, 100000);

            $count = User::where('email', '=', $email)->count();

            if ($count == 1) {
                Mail::to($email)->send(new OTPMail($otp));

                User::where('email', '=', $email)->update(["otp" => $otp]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'OTP sent',
                ], 200);

            } else {

                return response()->json([
                    'status' => 'error',
                    'message' => 'Sending OTP failed',
                ], 401);

            }
        } catch (Exception $e) {

            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
            ], 200);

        }
    }

    /// Verify OTP
    function VerifyOTP(Request $request) {
        try {
            $email = $request->input('email');
            $otp = $request->input('otp');

            $count = User::where('email', '=', $email)->where('otp', '=', $otp)->count();

            if ($count == 1) {
                User::where('email', '=', $email)->update(['otp' => '0']);

                $token = JWTToken::CreateTokenForSetPassword($request->input('email'));

                return response()->json([
                    'status' => 'success',
                    'message' => 'OTP Verification Successful',
                ], 200)->cookie('token', $token, 60 * 24 * 30);

            } else {

                return response()->json([
                    'status' => 'failed',
                    'message' => 'Unauthorized',
                ], 401);

            }
        } catch (Exception $e) {

            return response()->json([
                'status' => 'failed',
                'message' => 'Something went wrong',
            ], 401);

        }
    }

    /// Reset Password
    function ResetPassword(Request $request) {
        try {
            $email = $request->header('email');
            // $email = $request->input('email');
            $password = $request->input('password');
            User::where('email', '=', $email)->update(['password' => $password]);
            return response()->json([
                'status' => 'success',
                'message' => 'Password Updated',
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something Went Wrong',
            ], 401);
        }
    }
}
