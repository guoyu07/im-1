<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function errorRedirect($mas='失败！', $redirect_url='')
    {
        if($redirect_url) return redirect()->withErrors(['error_msg' => $mas]);
        return redirect()->back()->withErrors(['error_msg' => $mas])->withInput();
    }

    public function successRedirect($mas='成功！', $redirect_url='')
    {
        if($redirect_url) return redirect()->withErrors(['success_msg' => $mas]);
        return redirect()->back()->withErrors(['success_msg' => $mas]);
    }
}
