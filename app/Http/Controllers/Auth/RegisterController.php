<?php

namespace App\Http\Controllers\Auth;

use App\SocialProvider;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Socialite;
use Illuminate\Support\Str;
use Mail;
use App\Mail\VerifyEmail;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        Session::flash('status', 'Registered! please but verify your email to activate your account');
        $newUser = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verifyToken' => Str::random(40),
        ]);

        $verifyUser = User::findOrFail($newUser->id);
        $this->sendEmail($verifyUser);
    }

    public function verifyEmailFirst() 
    {
        return view('email.verifyEmailFirst');
    }

    public function sendEmail($user)
    {
        Mail::to($user['email'])->send(new VerifyEmail($user));
    }

    public function sendEmailDone($email, $verifyToken)
    {
        $user = User::where(['email' => $email, 'verifyToken' => $verifyToken])->first();
        if($user) {
            User::where(['email' => $email, 'verifyToken' => $verifyToken])
                ->update(['status' => '1', 'verifyToken' => NULL]);
        } else {
            return 'User not found';
        }
    }

    public function redirectToProvider($provide)
    {
        return Socialite::driver($provide)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('/');
        }

        //check if we have logged provider
        $socialProvider = SocialProvider::where('provider_id', $socialUser->getId())->first();
        if(!$socialProvider) {
            //create a new user and provider
            $user = User::firstOrCreate(
                ['email'    => $socialUser->getEmail()],
                ['name'     => $socialUser->getName()]
            );

            $user->socialProviders()->create(
                [
                    'provider_id'   => $socialUser->getId(),
                    'provider'      => $provider
                ]
            );
        } else {
            $user = $socialProvider->user;
        }

        auth()->login($user);

        return redirect('/home');
    }
}
