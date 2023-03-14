<?php

namespace App\Models;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


/**
     * Class helper to authenticate api requests
*/ 

class Auth
{

    /**
     * Validate API Credentials.
     *
     * @param  $login
     * @param  $password
     * @return bool // true for valid, false for invalid
     */
    private static function isValidCredentials($login, $password){
        $isValid = false;
        if (($login == env('API_LOGIN')) && (hash('sha256',$password) == env('API_PASSWORD'))){
            $isValid = True;
        }
        return $isValid;
    }


    /**
     * Generate JWT Token
     *
     * @param  $login
     * @param  $timeToExpire
     * @return string // JWT token
     */
    private static function generateToken($login, $timeToExpire){
        $iat = new \DateTimeImmutable();
        $payLoad['login'] = $login;
        $payLoad['iat'] = $iat->getTimestamp();
        $payLoad['exp'] = $iat->modify($timeToExpire)->getTimestamp();
        $JWT = JWT::encode($payLoad, env('JWT_KEY'), 'HS256');
        return $JWT;
    }  

    /**
     * Encapsulates private methods to authenticate
     *
     * @param  $login
     * @param  $password
     * @param  $timeToExpire
     * @return string // JWT token or empty value
     */
    public static function authenticate($login, $password, $timeToExpire){
        $JWT = '';
        if(Self::isValidCredentials($login,$password)){
            $JWT = Self::generateToken($login,$timeToExpire);   
        }
        return $JWT;
    }

    /**
     * Check the JWT is a valid token
     *
     * @param  $JWT
     * @return bool // return true for valid JWT or false to invalid token
     */
    public static function isValidToken($JWT){
        $isValid = true;
        try {
            $decoded = JWT::decode($JWT, new Key(env('JWT_KEY'), 'HS256'));
        } catch (\Exception $e) {
            $isValid =  false;
        }
        if (!isset($decoded->login)) {
            $isValid =  false;
        }
        if ($decoded->login != env('API_LOGIN')){
            $isValid =  false;
        }   
        
        return $isValid;
    }
}
