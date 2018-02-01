<?php

namespace App\Http\Controllers\Im;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $friends                  = $this->user->friends(userInfo()->id);
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


    public function find()
    {
        return view('im.index.find');
    }

    /**
     *上传图片
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadImage(Request $request)
    {
        $ext = ['JPG', 'JPEG', 'PNG', 'BMP', 'GIF'];

        if (!$request->hasFile('file')) return response()->json(['code' => 1, 'msg' => '请选择要上传的图片']);

        $file = $request->file('file');

        if (!$file->isValid()) return response()->json(['code' => 1, 'msg' => '上传图片失败']);

        if ($file->getSize() > 5242880) return response()->json(['code' => 1, 'msg' => '图片太大了']);

        if (!in_array(strtoupper($file->getClientOriginalExtension()), $ext)) {
            return response()->json(['code' => 1, 'msg' => '上传图片类型不符合']);
        }

        $file_path = '/uploads/im/images/';
        $filename  = md5(time() . rand(1000, 9999)) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($file_path), $filename);
        return response()->json(['code' => 0, 'msg' => '', 'data' => ['src' => $file_path . $filename]]);
    }

    /**
     * 上传文件
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function uploadFile(Request $request)
    {
        if (!$request->hasFile('file')) return response()->json(['code' => 1, 'msg' => '请选择要上传的文件']);

        $file = $request->file('file');

        if (!$file->isValid()) return response()->json(['code' => 1, 'msg' => '上传文件失败']);

        //20M
        if ($file->getSize() > 20971520) return response()->json(['code' => 1, 'msg' => '文件太大了']);

        $file_path = '/uploads/im/files/';
        $filename  = md5(time() . rand(1000, 9999)) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path($file_path), $filename);
        return response()->json(['code' => 0, 'msg' => '', 'data' => ['src' => $file_path . $filename, 'name' => $file->getClientOriginalName()]]);
    }


}
