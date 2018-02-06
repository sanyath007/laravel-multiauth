<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\User;

class AuthenticateController extends Controller
{

    public function __construct() 
    {
        // Apply the jwt.auth middleware to all methods in this controller
        // except for the authenticate method. We don't want to prevent
        // the user from retrieving their token if they don't already have it
        $this->middleware('jwt.auth', ['except' => ['tokenAuth', 'logout']]);

    }

    public function tokenAuth()
    {
        $credentials = request(['email', 'password']);

        try {
            //verify the credentials and create a token for the user
            if(!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            //sothing went wrong
            return reponse()->json(['error' => 'cloud_not_create_token'], 500);
        }

        //if no error are encountered we can return a JWT
        return response()->json(compact('token'));
    }
}