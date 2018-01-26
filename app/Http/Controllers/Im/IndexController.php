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

    public function webhooks()
    {
        $secret    = "123456";
        $path      = "/home/www/im";
        $signature = $_SERVER['HTTP_X_HUB_SIGNATURE'];
        if ($signature) {
            $hash = "sha1=" . hash_hmac('sha1', $HTTP_RAW_POST_DATA, $secret);
            if (strcmp($signature, $hash) == 0) {
                echo shell_exec("cd {$path} && /usr/bin/git reset --hard origin/master && /usr/bin/git clean -f && /usr/bin/git pull 2>&1");
                exit();
            }
        }
        http_response_code(404);
    }
}
