<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function changePasswordApi(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'secret' => ['required', 'string', 'min:8'],
        ]);

        if($validator->errors()->any()) {
            return response()->json(false);
        }
        if(Hash::check($request->get('secret'), $user->secret_password)) {
            $user->password = Hash::make($request->get('password'));
            $user->save();

            return response()->json(true);
        }

        return response()->json(false);
    }

    public function changeSecretPasswordApi(Request $request, User $user)
    {
        $secret = Str::random(8);
        while ($this->checkSecret($secret)) {
            $secret = Str::random(8);
        }
        $user->secret_password = Hash::make($secret);
        $user->save();
        Mail::send('mailSecret', ['user' => $user, 'secret' => $secret], function($message) use ($user) {
            $message->to($user->email, 'Секретний пароль')->subject
            ('Секретний пароль');
            $message->from('mcleinjohn06@gmail.com','Password Manager');
        });

        return response()->json(true);
    }

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
}
