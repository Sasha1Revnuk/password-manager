<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function quick()
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
