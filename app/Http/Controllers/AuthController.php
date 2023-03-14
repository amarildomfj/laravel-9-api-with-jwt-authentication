<?php

namespace App\Http\Controllers;

use App\Models\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Authenticates and returns the token to perform requests later
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate (Request $request){
        $response = ['error' => 'Invalid Credentials', 'status' => false];
        $responseCode = 401;

        if (($request->has(['login', 'password']))) {
            $JWT = Auth::authenticate($request->login, $request->password,'+20 minutes');
            if ($JWT != ''){
                $response = ['token' => $JWT, 'status' => true];
                $responseCode = 200;
            }
        }

        
        return response()->json($response, $responseCode);
    }

    /**
     * Method for testing authentication. Returns whether or not it is authenticated.
     *
     * @return \Illuminate\Http\Response
     */
    public function amIAuthenticated(){
        return response()->json(['response' => "I'm Authenticated"]);
    }
}
