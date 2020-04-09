<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function quick(User $user)
    {
        $data = [
            'meta' => [
                'pageTitle' => 'Швидкий доступ',
            ],
            'breadcrumb' => [
                'Швидкий доступ' => ''
            ],
        ];
        return view('quick', $data);
    }
}
