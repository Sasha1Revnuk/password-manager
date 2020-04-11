<?php

namespace App\Http\Controllers\Auth;

use App\Enumerators\UserEnumerator;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    private function checkSecret($secret)
    {
        $users = User::all();
        foreach ($users as $user)
        {
            if(Hash::check($secret, $user->secret_password)) {
                return true;
            }
        }

        return false;
    }
    protected function create(array $data)
    {
        $token = Str::random(64);
        $secret = Str::random(8);
        while ($this->checkSecret($secret)) {
            $secret = Str::random(8);
        }

        $emailIdArray = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'];
        shuffle($emailIdArray);
        $emailId = '';
        for($i = 0; $i < 32; $i++) {
            $emailId .= $emailIdArray[mt_rand(0, count($emailIdArray)-1)];
        }

        $emailId = str_shuffle($emailId);
        return [User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'email_id' => $emailId,
            'password' => Hash::make($data['password']),
            'secret_password' => Hash::make($secret),
            'is_active' => UserEnumerator::STATUS_UNACTIVE,
            'api_token' => $token,
            'confirm_code' => Str::random(64),
        ]), $secret];
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        event(new Registered($user[0]));

        return $this->registered($request, $user[0])
            ?: $this->successRegister($user[0], $user[1]);
    }

    private function successRegister($user, $secret)
    {
        Mail::send('mailSecret', ['user' => $user, 'secret' => $secret], function($message) use ($user) {
            $message->to($user->email, 'Секретний пароль')->subject
            ('Секретний пароль');
            $message->from('mcleinjohn06@gmail.com','Password Manager');
        });

        return redirect('/sendhtmlemail/' . $user->id . '?secret=1');
    }
}
