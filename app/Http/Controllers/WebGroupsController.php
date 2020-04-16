<?php

namespace App\Http\Controllers;

use App\User;
use App\Web;
use App\WebGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebGroupsController extends Controller
{
    public function add(User $user, Request $request)
    {
        $group = new WebGroup();
        $group->name = $request->get('name') ?: 'Стандартна група';
        $group->user_id = Auth::user()->id;

        return response()->json($group->save());
    }

    public function edit(User $user, WebGroup $group, Request $request)
    {
        if($request->get('name')) {
            $group->name = $request->get('name');
            $group->save();
        }

        return response()->json(true);
    }

    public function get(User $user, Web $web)
    {
        return response()->json(WebGroup::where('id', '<>', $web->id)->get()->makeHidden(['created_at', 'updated_at', 'user_id'])->toArray());
    }


    public function show(User $user, WebGroup $group)
    {
        $data = [
            'meta' => [
                'pageTitle' => 'Облікові записи групи ' . $group->name,
            ],
            'breadcrumb' => [
                'Облікові записи ' => route('webs', ['user' => $user->id]),
                'Облікові записи групи ' . $group->name => '',
            ],
            'user' => $user,
            'group' => $group,
        ];
        return view('group.index', $data);
    }

    public function getApi(User $user, WebGroup $group, Request $request)
    {
        $webs = $group->webs();


        if($request->get('url')) {
            $webs = $webs->where('url', 'LIKE', '%' . $request->get('url') . '%');
        }

        $resourcesCount = $webs->count();
        $webs = $webs->orderBy('id', 'desc')->offset($request->get('start'))->limit($request->get('length'))->get();

        $resources = $webs;

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
                                                        <a class="dropdown-item deleteFromGroup" data-id="' . $resource->id . '">Видалити з групи</a>
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
                                                        <a class="dropdown-item deleteFromGroup" data-id="' . $resource->id . '">Видалити з групи</a>
                                                        <a class="dropdown-item deleteWeb"  data-id="' . $resource->id . '">Видалити</a>
                                                    </div></div></div>';
                    }
                }
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

    public function deleteForce(User $user, WebGroup $group)
    {
        return response()->json($group->delete());
    }

    public function unGroup(User $user, WebGroup $group)
    {
        $webs = $group->webs;
        foreach ($webs as $web){
            $web->web_group_id = null;
            $web->save();
        }
        return response()->json(true);
    }
}
