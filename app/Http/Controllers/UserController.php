<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;

class UserController extends Controller
{
	public function __construct() 
    {
        // Apply the jwt.auth middleware to all methods in this controller
        // except for the authenticate method. We don't want to prevent
        // the user from retrieving their token if they don't already have it
        $this->middleware('jwt.auth');
    }

    public function index()
    {
        $user = User::all();

        return $user;
    }
}
