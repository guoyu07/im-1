<?php

namespace App\Http\Controllers\Im;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

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

    public function qq()
    {
        $APP_ID        = '101455971';
        $code          = 'F28996706C36AAE70DE9AD4A3061A4A1';
        $user_data_url = "https://graph.qq.com/oauth2.0/me?access_token={$code}";
        $user_data     = file_get_contents($user_data_url);//此为获取到的openid与appid信息
        preg_match_all('/{ *[^>]*}/i', $user_data, $matches);
        //        dd($matches);
        if (empty(json_decode($matches[0][0])->openid)) {
            dd('失败');
        }
        $openid         = json_decode($matches[0][0])->openid;
        $user_info_url  = "https://graph.qq.com/user/get_user_info?access_token={$code}&oauth_consumer_key={$APP_ID}&openid={$openid}";
        $user_info_data = file_get_contents($user_info_url); //此为获取到的user信息
        $user_data      = json_decode($user_info_data);
        $data           = [
            'certificate'   => $openid,
            'platform'      => 3,
            'wechat_openid' => '',
            'name'          => $user_data->nickname,
            'avatar'        => $user_data->figureurl_2,
        ];
        dd($data);

    }

    public function weibo()
    {
        $code      = '9a19ace82717c25edaf448b248ab123c';
        $uid       = '1751478944';
        $url       = "https://api.weibo.com/oauth2/get_token_info";
        $post_data = array(
            "access_token" => $code,
        );
        $ch        = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //设置为POST
        curl_setopt($ch, CURLOPT_POST, 1);
        //把POST的变量加上
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $output = curl_exec($ch);
        curl_close($ch);
        dd($output);
    }

    public function weiXin()
    {
        $code= $_GET['code'];//前端传来的code值

        $appid= "";

        $appsecret= "";

        //获取openid

        $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$appsecret&code=$code&grant_type=authorization_code";

        $result= https_request($url);

        $jsoninfo= json_decode($result, true);

        $openid= $jsoninfo["openid"];//从返回json结果中读出openid

        echo$openid; //把openid送回前端
    }
}
