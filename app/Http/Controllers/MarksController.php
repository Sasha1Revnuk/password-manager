<?php

namespace App\Http\Controllers;

use App\Mark;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MarksController extends Controller
{
    public function index(User $user)
    {
        $data = [
            'meta' => [
                'pageTitle' => 'Закладки',
            ],
            'breadcrumb' => [
                'Закладки' => ''
            ],
            'user' => $user,
        ];
        return view('marks.index', $data);
    }

    public function getApi(User $user, Request $request)
    {
        $marks = $user->marks();

        $resourcesCount = $marks->count();
        $marks = $marks->orderBy('id', 'desc')->offset($request->get('start'))->limit($request->get('length'))->get();

        $resources = collect();
        $resources = $resources->merge($marks);

        $data = [];
        foreach ($resources as $resource) {
            $url = parse_url($resource->url);

            if (!isset($url['path']) OR !$url['path'] OR !isset($url['scheme'])) {
                $url = 'http://' . $url['host'];
            } else {
                $url = $resource->url;
            }
            $name = '<b>' . $resource->name . '</b>';
            $url ='<a href="' . $url . '" target="_blank">' . $resource->url . '<i class="ml-2 fal fa-external-link" aria-hidden="true"></i></a>';
            $buttons = '';
            $buttons .= '<br /><a data-toggle="modal" data-target="#editMark" class="btn btn-sm btn-outline-success btn-icon waves-effect waves-themed edit" data-id="' . $resource->id . '" data-url="'.$resource->url.'"><i class="fal fa-edit"></i></a> 
                        | <button class="btn btn-sm btn-outline-danger btn-icon waves-effect waves-themed delete"  data-id="' . $resource->id . '"><i class="fal fa-trash" aria-hidden="true"></i></button><hr />';

            $data[] = [
                $name,
                $url,
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

    public function add(User $user, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => ['required'],
        ]);

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
        $mark = new Mark();
        $mark->name = $name;
        $mark->url = $url;
        $mark->user_id = Auth::id();
        $mark->save();

        return response()->json(true);
    }

    public function edit(User $user, Mark $mark,  Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => ['required'],
        ]);

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
        $mark->name = $name;
        $mark->url = $url;
        $mark->save();

        return response()->json(true);
    }

    public function delete(User $user, Mark $mark)
    {
        return response()->json($mark->delete());
    }

}
