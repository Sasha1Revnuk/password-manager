<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddWebPassword;
use App\Services\PasswordService;
use App\User;
use App\Web;
use App\WebResource;
use Illuminate\Http\Request;
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

        $password =new PasswordService();
        $password = $password->encrypt($request->get('password'));

        $resource = new WebResource();
        $resource->login = $request->get('login');
        $resource->password = $password;
        $resource->web_id = $web->id;
        $resource->save();

        return redirect()->route('webs', ['user' => $user->id]);
    }
}
