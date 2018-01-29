<?php

namespace App\Http\Controllers\Im;

use App\Repositories\MessageBoxRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageBoxController extends Controller
{
    protected $messageBox;

    public function __construct(MessageBoxRepository $messageBoxRepository)
    {
        $this->messageBox = $messageBoxRepository;
    }

    public function index()
    {

        return view('im.messageBox.index');
    }
}
