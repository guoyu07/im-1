<?php

namespace App\Http\Controllers\Im;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('im.index.index');
    }

    public function friends()
    {

    }

}
