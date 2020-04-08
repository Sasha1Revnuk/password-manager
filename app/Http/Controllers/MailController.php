<?php

namespace App\Http\Controllers;

use App\Enumerators\UserEnumerator;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function htmlEmail(User $user){
        if($user->isActive) {
            return redirect('/');
        }
        $data = array('user'=> $user, 'link' => config('app.url') .'/confirm/'.$user->id.'/'.$user->confirm_code .'/');
        Mail::send('mail', $data, function($message) use ($user) {
            $message->to($user->email, 'Підтвердження акануту')->subject
            ('Підтвердження акаунту');
            $message->from('mcleinjohn06@gmail.com','Password Manager');
        });

        return view('auth.confirm-account', ['secret' => request('secret')]);
    }

    public function confirm(User $user, $code)
    {
        if($user && $user->confirm_code == $code) {
            $user->isActive = UserEnumerator::STATUS_ACTIVE;
            $user->save();
            return redirect()->route('mailConfirmSuccess');
        }
        return redirect('/');
    }

    public function confirmSucces()
    {
        return view('auth.confirm-account-succes');
    }
}
