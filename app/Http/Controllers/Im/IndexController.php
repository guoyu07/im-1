<?php

namespace App\Http\Controllers\Im;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class IndexController extends Controller
{
    protected $user;

    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }

    public function index()
    {
        $userInfo = $this->user->find(userInfo()->id);
        return view('im.index.index', compact('userInfo'));
    }


    /**
     * 初始化数据
     * @return \Illuminate\Http\JsonResponse
     */
    public function init()
    {
        $friends = $this->user->friends(userInfo()->id);
        $data['mine']['username'] = $friends->name;
        $data['mine']['id']       = $friends->id;
        $data['mine']['status']   = 'online';
        $data['mine']['avatar']   = $friends->avatar;
        $data['mine']['sign']     = $friends->sign;
        foreach ($friends->friendGroups as $k => $v) {
            $data['friend'][$k]['groupname'] = $v->name;
            $data['friend'][$k]['id']        = $v->id;
            foreach ($v->friends as $key => $friend) {
                $data['friend'][$k]['list'][$key]['username'] = $friend->users->name;
                $data['friend'][$k]['list'][$key]['id']       = $friend->users->id;
                $data['friend'][$k]['list'][$key]['avatar']   = $friend->users->avatar;
                $data['friend'][$k]['list'][$key]['sign']     = $friend->users->sign;
            }
        }
        return response()->json(['code' => 0, 'msg' => '', 'data' => $data]);
    }
}
