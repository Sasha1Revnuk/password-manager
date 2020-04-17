<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteAdd;
use App\Http\Requests\NoteEdit;
use App\Note;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function index(User $user)
    {
        $data = [
            'meta' => [
                'pageTitle' => 'Нотатки',
            ],
            'breadcrumb' => [
                'Нотатки' => ''
            ],
            'user' => $user,
        ];
        return view('notes.index', $data);
    }

    public function getApi(User $user, Request $request)
    {
        $notes = $user->notes();

        $resourcesCount = $notes->count();
        $notes = $notes->orderBy('id', 'desc')->offset($request->get('start'))->limit($request->get('length'))->get();

        $resources = collect();
        $resources = $resources->merge($notes);

        $data = [];
        foreach ($resources as $resource) {

            $name = '<a href="'.route('showNote', ['user' => Auth::id(), 'note' =>$resource->id ]).'" ><b>' . $resource->name . '</b></a>' ;
            $buttons = '';
            $buttons .= '<br /><a  href="'.route('editNote', ['user' => Auth::id(), 'note' => $resource->id]).'" class="btn btn-sm btn-outline-success btn-icon waves-effect waves-themed edit" data-id="' . $resource->id . '" data-url="'.$resource->url.'"><i class="fal fa-edit"></i></a> 
                        | <button class="btn btn-sm btn-outline-danger btn-icon waves-effect waves-themed delete"  data-id="' . $resource->id . '"><i class="fal fa-trash" aria-hidden="true"></i></button><hr />';

            $data[] = [
                $name,
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

    public function addForm(User $user)
    {
        $data = [
            'meta' => [
                'pageTitle' => 'Додати нотатки',
            ],
            'breadcrumb' => [
                'Нотатки' => route('notes', ['user' => Auth::id()]),
                'Додати нотатки' => ''
            ],
            'user' => $user,
        ];
        return view('notes.add', $data);
    }

    public function add(User $user, NoteAdd $request)
    {
        $note = new Note();
        $note->name = $request->input('name');
        $note->text = $request->input('text');
        $note->user_id = $user->id;
        $note->save();

        return redirect()->route('showNote', ['user' => $user->id, 'note' => $note->id]);
    }

    public function edit(User $user, Note $note)
    {
        $data = [
            'meta' => [
                'pageTitle' => 'Редагувати ' . $note->name,
            ],
            'breadcrumb' => [
                'Нотатки' => route('notes', ['user' => Auth::id()]),
                'Редагувати ' . $note->name => ''
            ],
            'user' => $user,
            'note' => $note,
        ];
        return view('notes.edit', $data);
    }

    public function update(User $user, Note $note, NoteEdit $request)
    {
        $note->name = $request->input('name');
        $note->text = $request->input('text');
        $note->save();

        return redirect()->route('editNote', ['user' => $user->id, 'note' => $note->id]);
    }

    public function show(User $user, Note $note)
    {
        $data = [
            'meta' => [
                'pageTitle' => $note->name,
            ],
            'breadcrumb' => [
                'Нотатки' => route('notes', ['user' => Auth::id()]),
                $note->name => ''
            ],
            'user' => $user,
            'note' => $note,
        ];
        return view('notes.show', $data);
    }

    public function delete(User $user, Note $note)
    {
        return response()->json($note->delete());
    }
}
