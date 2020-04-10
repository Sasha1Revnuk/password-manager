<?php

namespace App\Http\Controllers;

use App\Services\PasswordService;
use App\User;
use App\Web;
use App\WebGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Collection\Collection;

class WebController extends Controller
{
    public function index(User $user)
    {
        $data = [
            'meta' => [
                'pageTitle' => 'Облікові записи інтерену',
            ],
            'breadcrumb' => [
                'Облікові записи інтернету' => ''
            ],
            'user' => $user,
            'groups' => $user->webGroups,
        ];
        return view('web.index', $data);
    }

    public function getApi(User $user, Request $request)
    {
        $groups = $user->webGroups();
        $webs = $user->webs();


        if($request->get('url')) {
            $groups = $groups->where('name', 'LIKE', '%' . $request->get('url') . '%');
            $webs = $webs->where('url', 'LIKE', '%' . $request->get('url') . '%');
        }

        $resourcesCount = $groups->count() + $webs->count();
        $groups = $groups->orderBy('id', 'desc')->offset($request->get('start'))->limit($request->get('length'))->get();
        $webs = $webs->orderBy('id', 'desc')->offset($request->get('start'))->limit($request->get('length'))->get();

        $resources = collect();
        $resources = $resources->merge($groups)->merge($webs);

        $data = [];
        foreach ($resources as $resource) {
            if(is_object($resource) && get_class($resource) === Web::class){
                $fa = '<i class="fal fa-file fa-2x" aria-hidden="true"></i>';
                $url = parse_url($resource->url);

                if ( !$url['path'] OR ! isset($url['scheme']))
                {
                    $url = 'http://'.$url['path'];
                } else {
                    $url = $resource->url;
                }
                $name ='<b>' . $resource->name . '</b><br /><a href="' . $url . '" target="_blank">'. $resource->url .'<i class="ml-2 fal fa-external-link" aria-hidden="true"></i></a>';
                if($resource->resources()->count() > 1) {
                    $login =' <button type="button" data-web="' . $resource->id . '" class="btn btn-xs btn-info waves-effect waves-themed block">Переглянути облікові записи</button>';
                    $buttons = '<a href="' . $url . '" class="btn btn-outline-success btn-icon waves-effect waves-themed mr-2">
                                                        <i class="fal fa-external-link"></i>
                                                    </a><div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-themed" data-toggle="dropdown" aria-expanded="false">Дії</button>
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: top, left; top: 35px; left: 0px;">
                                                        <a class="dropdown-item" href="#" data-id="' . $resource->id . '">Редагувати</a>
                                                        <a class="dropdown-item" href="#" data-id="' . $resource->id . '">Переглянути</a>
                                                        <a class="dropdown-item" href="#" data-id="' . $resource->id . '">Додати обліковий запис</a>
                                                        <a class="dropdown-item" href="#" data-id="' . $resource->id . '">Додати в швидкий доступ</a>
                                                        <a class="dropdown-item" href="#" data-id="' . $resource->id . '">Видалити</a>
                                                    </div></div>';
                } else {
                    $log =  $resource->resources;
                    if(!$log->isEmpty()) {
                        $login = $log->first()->login;
                        $buttons = '<a href="' . $url . '" class="btn btn-outline-success btn-icon waves-effect waves-themed mr-2">
                                                        <i class="fal fa-external-link"></i>
                                                    </a><div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-themed" data-toggle="dropdown" aria-expanded="false">Дії</button>
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: top, left; top: 35px; left: 0px;">
                                                        <a class="dropdown-item" href="#" data-id="' . $resource->id . '">Редагувати</a>
                                                        <a class="dropdown-item" href="#" data-id="' . $resource->id . '">Додати обліковий запис</a>
                                                        <a class="dropdown-item" href="#" data-id="' . $resource->id . '">Переглянути</a>
                                                        <a class="dropdown-item" href="#" data-id="' . $resource->id . '">Скопіювати пароль</a>
                                                        <a class="dropdown-item" href="#" data-id="' . $resource->id . '">Додати в швидкий доступ</a>
                                                        <a class="dropdown-item" href="#" data-id="' . $resource->id . '">Видалити</a>
                                                    </div></div></div>';
                    } else {
                        $login = 'Облікові записи не додані';
                        $buttons = 'Облікові записи не додані';
                    }
                }
            } else if(is_object($resource) && get_class($resource) === WebGroup::class) {
                $fa = '<i class="fal fa-folder fa-2x" aria-hidden="true"></i>';
                $name ='<a href="#" class="btn btn-outline-success waves-effect waves-themed">'. $resource->name .'<i class="ml-2 fal fa-forward" aria-hidden="true"></i></a>';
                $login ='-';
                $buttons = '<button class="btn btn-outline-success btn-icon waves-effect waves-themed mr-2" title="Розгрупувати">
                                                        <i class="fal fa-object-group"></i>
                                                    </button><div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-themed" data-toggle="dropdown" aria-expanded="false">Дії</button>
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: top, left; top: 35px; left: 0px;">
                                                       <a class="dropdown-item" href="#" data-id="' . $resource->id . '">Редагувати</a>
                                                        <a class="dropdown-item" href="#" data-id="' . $resource->id . '">Видалити із посиланнями</a>
                                                    </div>
                                                </div></div>';
            }
            $data[] = [
                $fa,
                $name,
                $login,
                $buttons
            ];


        }

        $responseData = [
            'data' => $data,
            'recordsTotal' => $resourcesCount,
            'recordsFiltered' => $resourcesCount,
        ];
        return response()->json($responseData);
    }

    public function generatePasswordApi(User $user, Request $request)
    {
        $big = ((int)$request->get('big') ?: null);
        $sym = ((int)$request->get('sym') ?: null);
        $count = ((int)$request->get('count') ?: null);
        $password = PasswordService::generate($big, $sym, $count);

        return response()->json($password);
    }

    public function addWebApi(User $user, Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'url' => ['required'],
//            'login' => ['required'],
//            'password' => ['required','min:8'],
//        ]);


//        if($validator->errors()->any()) {
//            return response()->json(false);
//        }

        $url = parse_url($request->get('url'));

        if ( !$url['path'] OR ! isset($url['scheme']))
        {
            $url = 'http://'.$url['path'];
        } else {
            $url = $request->get('url');
        }

        $name = parse_url($url)['host'] ?: parse_url($url)['path'];
        $password =new PasswordService();
        $password = $password->crypt($request->get('password'));
        dd($password);
    }
}
