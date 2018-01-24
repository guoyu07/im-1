<?php

namespace App\Http\Controllers\Im;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginPost;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    protected $user;

    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }

    /**
     *
     */
    public function login()
    {
        return view('im.login.login');
    }

    public function doLogin(LoginPost $request)
    {
        $user = $this->user->findByAttributes(['email' => $request->email]);
        if(!Hash::check($request->password, $user['password'])){
            return $this->errorRedirect('账号或密码错误！');
        }
        session(['user'=> $user]);
        return $this->successRedirect('登录成功！', url('index'));
    }
}
