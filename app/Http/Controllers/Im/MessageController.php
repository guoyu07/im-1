<?php

namespace App\Http\Controllers\Im;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index()
    {
        return view('im.message.index');
    }
}
