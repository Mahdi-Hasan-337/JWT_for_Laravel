<?php

namespace App\Helper;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken {
    public static function createToken($userEmail) {
        $key = env('JWT_key');
        $payload = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() + 60 * 60,
            'userEmail' => $userEmail,
        ];

        $encode = JWT::encode($payload, $key, 'HS256');
        return $encode;
    }

    public static function createTokenForSetPassword($userEmail) {
        $key = env('JWT_key');
        $payload = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() + 60 * 5,
            'userEmail' => $userEmail,
        ];

        $encode = JWT::encode($payload, $key, 'HS256');
        return $encode;
    }

    public static function verifyToken($token) {
        try {

            $key = env('JWT_key');
            $decode = JWT::decode($token, new Key($key, 'HS256'));
            return $decode->userEmail;

        } catch (Exception $e) {
            return "Unauthorized";
        }
    }
}
