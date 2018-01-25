<?php

namespace App\Http\Controllers\Im;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }

    public function index()
    {
        $user = $this->user->login();
        dd($user);
    }
    public function friends(){
        $data = $this->user->friends(userId());
        dd($data->toArray());
    }
}
