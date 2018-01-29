<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class WebSocket extends Command
{

    protected $server;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'websocket:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start Web Socket Server!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 监听所有地址，监听 9501 端口
        $this->server = new \swoole_websocket_server('0.0.0.0', 9501);
        // 设置 server 运行前各项参数
        // 调试的时候把守护进程关闭，部署到生产环境时再把注释取消
        $this->server->set([
            'worker_num' => 4,
            // 守护进程化
            'daemonize'  => false,
            // 监听队列的长度
            'backlog'    => 128
        ]);

        // 建立连接时回调函数
        $this->server->on('open', [$this, 'onOpen']);

        // 收到数据时回调函数
        $this->server->on('message', [$this, 'onMessage']);

        // 连接关闭时回调函数
        $this->server->on('close', [$this, 'onClose']);

        $this->server->start();
    }

    public function onOpen($server, $request)
    {
        echo "server: handshake success with fd {$request->fd}\n";
    }

    public function onMessage(\swoole_websocket_server $server, \swoole_websocket_frame $frame)
    {
        $data = json_decode($frame->data);
        //        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
        switch ($data->type) {
            case 'init':
                Cache::forever($data->id, $frame->fd);
                $init = json_encode(['type' => 'init']);
                $server->push($frame->fd, $init);
                break;
            case 'friend':
                $fd = Cache::get($data->data->to->id);
                $server->push($fd, $frame->data);
                break;
        }

    }


    public function onClose($server, $fd)
    {
        echo "client {$fd} closed\n";
    }
}
