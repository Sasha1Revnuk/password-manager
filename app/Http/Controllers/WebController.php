<?php

namespace App\Http\Controllers;

use App\Enumerators\UserEnumerator;
use App\Services\PasswordService;
use App\User;
use App\Web;
use App\WebGroup;
use App\WebResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Collection\Collection;

class WebController extends Controller
{
    public function index(User $user)
    {
        $data = [
            'meta' => [
                'pageTitle' => 'Облікові записи',
            ],
            'breadcrumb' => [
                'Облікові записи' => ''
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
            if($resource->web_group_id){
                continue;
            }
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
                $quick = 'Додати до швидкого доступу';
                if($resource->onQuick) {
                    $quick = 'Видалити зі швидкого доступу';
                }
                if($resource->resources()->count() > 1) {
                    $logins = $resource->resources;
                    $login = '';
                    foreach ($logins as $log) {
                        $login .= $log->login . '<br /><a class="btn btn-sm btn-outline-success btn-icon waves-effect waves-themed" href="'. route('editSystemResourceForm', ['user'=>Auth::id(), 'resource' =>$log->id ]).'" data-id="' . $log->id . '"><i class="fal fa-edit"></i></a> 
                        | <button class="btn btn-sm btn-outline-info btn-icon waves-effect waves-themed copyPassword" data-method="' . $log->method . '" data-id="' . $log->id . '"><i class="fal fa-copy"></i></button> 
                        | <button class="btn btn-sm btn-outline-danger btn-icon waves-effect waves-themed deleteObl"  data-id="' . $log->id . '"><i class="fal fa-trash" aria-hidden="true"></i></button><hr />';
                    }
                    $buttons = '<a href="' . $url . '" class="btn btn-outline-success btn-icon waves-effect waves-themed mr-2">
                                                        <i class="fal fa-external-link"></i>
                                                    </a><div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-themed" data-toggle="dropdown" aria-expanded="false">Дії</button>
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: top, left; top: 35px; left: 0px;">
                                                        <a class="dropdown-item" href="'. route('addFormResource', ['user'=>Auth::id(), 'web' =>$resource->id ]).'" data-id="' . $resource->id . '">Додати обліковий запис</a>
                                                        <a class="dropdown-item addToQuick" data-id="' . $resource->id . '">'. $quick .'</a>
                                                        <a class="dropdown-item addToGroup" data-toggle="modal" data-target="#addToGroup" data-id="' . $resource->id . '">Додати в групу</a>
                                                        <a class="dropdown-item deleteWeb"  data-id="' . $resource->id . '">Видалити</a>
                                                    </div></div>';
                } else {
                    $log =  $resource->resources;
                    if(!$log->isEmpty()) {
                        $res =  $log->first();
                        $login =$res->login;
                        $buttons = '<a href="' . $url . '" class="btn btn-outline-success btn-icon waves-effect waves-themed mr-2">
                                                        <i class="fal fa-external-link"></i>
                                                    </a><div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-themed" data-toggle="dropdown" aria-expanded="false">Дії</button>
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: top, left; top: 35px; left: 0px;">
                                                        <a class="dropdown-item" href="'. route('editSystemResourceForm', ['user'=>Auth::id(), 'resource' =>$resource->resources()->first()->id ]).'" data-id="' . $resource->id . '">Редагувати</a>
                                                        <a class="dropdown-item" href="'. route('addFormResource', ['user'=>Auth::id(), 'web' =>$resource->id ]).'" data-id="' . $resource->id . '">Додати обліковий запис</a>
                                                        <a class="dropdown-item copyPassword" data-method="' . $res->method . '" data-id="' . $res->id . '">Скопіювати пароль</a>
                                                        <a class="dropdown-item addToQuick" data-id="' . $resource->id . '">'. $quick .'</a>
                                                        <a class="dropdown-item addToGroup" data-id="' . $resource->id . '" data-toggle="modal" data-target="#addToGroup" >Додати в групу</a>
                                                        <a class="dropdown-item deleteWeb"  data-id="' . $resource->id . '">Видалити</a>
                                                    </div></div></div>';
                    } else {
                        $login = 'Облікові записи не додані';
                        $buttons ='<div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-themed" data-toggle="dropdown" aria-expanded="false">Дії</button>
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: top, left; top: 35px; left: 0px;">
                                                        <a class="dropdown-item deleteWeb"  data-id="' . $resource->id . '">Видалити</a>
                                                    </div></div></div>' ;
                    }
                }
            } else if(is_object($resource) && get_class($resource) === WebGroup::class) {
                $fa = '<i class="fal fa-folder fa-2x" aria-hidden="true"></i>';
                $name ='<a href="'. route('showGroup', ['user' => Auth::id(), 'group' => $resource->id]).'" class="btn btn-outline-success waves-effect waves-themed">'. $resource->name .'<i class="ml-2 fal fa-forward" aria-hidden="true"></i></a>';
                $websCount =  $resource->webs()->count();
                $login = $websCount . ' ресурсів';
                $ungroupButton = $websCount > 0 ? '<button class="btn btn-outline-success btn-icon waves-effect waves-themed mr-2 unGroup" data-id="'.$resource->id.'" title="Розгрупувати">
                                                        <i class="fal fa-object-group"></i>
                                                    </button>' : '';
                $buttons = $ungroupButton . '<div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-primary dropdown-toggle waves-effect waves-themed" data-toggle="dropdown" aria-expanded="false">Дії</button>
                                                    <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: top, left; top: 35px; left: 0px;">
                                                       <a class="dropdown-item editGroupHref" data-toggle="modal" data-name="'. $resource->name .'" data-target="#editGroupModal" data-id="' . $resource->id . '">Редагувати</a>
                                                        <a class="dropdown-item deleteGroupForce" data-id="' . $resource->id . '">Видалити із посиланнями</a>
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

    public function addWebApi(User $user, Request $request, WebGroup $group=null)
    {
        if((int)$request->get('shifr') === UserEnumerator::METHOD_SECRET) {
            $validator = Validator::make($request->all(), [
                'url' => ['required'],
                'login' => ['required'],
                'password' => ['required','min:8'],
                'secret' => ['required','min:8'],
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'url' => ['required'],
                'login' => ['required'],
                'password' => ['required','min:8'],
            ]);
        }


        if($validator->errors()->any()) {
            return response()->json(false);
        }

        $url = parse_url($request->get('url'));

        if ( !$url['path'] OR ! isset($url['scheme']))
        {
            $url = 'http://'.$url['path'];
        } else {
            $url = $request->get('url');
        }


        $name = parse_url($url)['host'] ?: parse_url($url)['path'];
        $web = new Web();
        $web->name = $name;
        $web->url = $request->get('url');
        $web->user_id = Auth::id();
        if($group) {
            $web->web_group_id = (int)$group;
        }
        $web->save();

        $resource = new WebResource();
        if((int)$request->get('shifr') === UserEnumerator::METHOD_SECRET) {
            //dd(Auth::user()->secret_password    );
            if(Hash::check($request->get('secret'), Auth::user()->secret_password)) {
                $password =new PasswordService();
                $password = $password->encrypt($request->get('password'), $request->get('secret'));
                $resource->method = UserEnumerator::METHOD_SECRET;

            } else {
                $web->delete();
                return response()->json(false);
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

        return response()->json(true);
    }

    public function deleteApi(User $user, Web $web)
    {
        return response()->json($web->delete());
    }

    public function addToQuick(User $user, Web $web)
    {
        if($web->onQuick) {
            $web->onQuick = 0;
            $message = 'Видалено із швидкого доступу';
        } else {
            $web->onQuick = 1;
            $message = 'Додано до швидкого доступу';
        }
        $web->save();
        return response()->json($message);
    }

    public function addToGroup(User $user, Web $web, Request $request)
    {
        $web->web_group_id = $request->get('group')?: null;
        return response()->json($web->save());
    }
    public function deleteFromGroup(User $user, Web $web)
    {
        $web->web_group_id = null;
        return response()->json($web->save());
    }


}
