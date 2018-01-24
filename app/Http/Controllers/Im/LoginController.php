<?php

namespace App\Http\Controllers\Im;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginPost;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     *
     */
    public function login()
    {
        return view('im.login.login');
    }

    public function doLogin(LoginPost $request)
    {

        dd($request->name);
        dd(123);
    }
}
