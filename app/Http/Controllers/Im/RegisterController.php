<?php

namespace App\Http\Controllers\Im;

use App\Repositories\{
    UserRepository, FriendGroupRepository
};
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;
    protected $friendGroup;
    protected $user;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository, FriendGroupRepository $friendGroupRepository)
    {
        $this->middleware('guest');
        $this->user        = $userRepository;
        $this->friendGroup = $friendGroupRepository;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     * @param array $data
     * @return mixed
     */
    protected function create(array $data)
    {
        return $this->user->create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $data['password'],
            'avatar'   => 'https://gitee.com/uploads/64/892364_cjade.png'
        ]);
    }

    public function register(Request $request)
    {
        DB::transaction(function () use ($request) {
            $user            = $this->create($request->all());
            $data['user_id'] = $user->id;
            $data['name']    = '默认分组';
            $this->friendGroup->create($data);
        });
        return $this->successRedirect('注册成功！', url('login'));
    }
}
