<?php

namespace App\Http\Controllers;

use App\Enumerators\UserEnumerator;
use App\Http\Requests\AddWebPassword;
use App\Services\PasswordService;
use App\User;
use App\Web;
use App\WebResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class WebResourceController extends Controller
{
    public function addForm(User $user, Web $web)
    {
        $data = [
            'meta' => [
                'pageTitle' => 'Додати обліковий запис для ' . $web->name,
            ],
            'breadcrumb' => [
                'Облікові записи інтернету' => route('webs', ['user' => $user->id]),
                'Додати обліковий запис для ' . $web->name=> ''
            ],
            'user' => $user,
            'web' => $web,

        ];
        return view('web.addPassword', $data);
    }
    public function add(User $user, Web $web, AddWebPassword $request)
    {
        $resource = new WebResource();
        if((int)$request->get('shifr') === UserEnumerator::METHOD_SECRET) {
            if(Hash::check($request->get('secret'), Auth::user()->secret_password)) {
                $password =new PasswordService();
                $password = $password->encrypt($request->get('password'), $request->get('secret'));
                $resource->method = UserEnumerator::METHOD_SECRET;
            } else {
                return redirect()->back();
            }
        } else {
            $password =new PasswordService();
            $password = $password->encrypt($request->get('password'), Auth::user()->email_id);
            $resource->method = UserEnumerator::METHOD_KEY;
        }

        $resource->login = $request->get('login');
        $resource->password = $password;
        $resource->web_id = $web->id;
        $resource->user_id = Auth::id();
        $resource->save();

        return redirect()->route('webs', ['user' => $user->id]);
    }

    public function editSystemForm(User $user, WebResource $resource)
    {
        $password = '';
        if($resource->method === UserEnumerator::METHOD_SECRET) {
            for($i = 0; $i < strlen($resource->password); $i++) {
                $password .= '*';
            }
        } else {
            $passwordService = new PasswordService();
            $password = $passwordService->decrypt($resource->password, Auth::user()->email_id);
        }
        $data = [
            'meta' => [
                'pageTitle' => 'Редагувати обліковий запис',
            ],
            'breadcrumb' => [
                'Облікові записи інтернету' => route('webs', ['user' => $user->id]),
                'Додати обліковий запис '=> ''
            ],
            'user' => $user,
            'resource' => $resource,
            'password' => $password

        ];
        return view('web.editResource', $data);
    }
}
