<?php

namespace App\Http\Controllers\Im;

use App\Repositories\FriendRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FriendController extends Controller
{
    protected $friend;

    public function __construct(FriendRepository $friendRepository)
    {
        $this->friend = $friendRepository;
    }

    public function lists()
    {
        $data = $this->friend->friends(userId());
        dd($data->toArray());
    }
}
