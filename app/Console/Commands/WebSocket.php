<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $this->server->on('open', function (\swoole_websocket_server $server, \swoole_http_request $request){

            echo "server: handshake success with fd{$request->fd}\n";
            echo '连接了';
        });

        // 收到数据时回调函数
        $this->server->on('message', function (\swoole_websocket_server $server, \swoole_websocket_frame $frame){
            echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
            foreach ($server->connection_list() as $fd) {
                if ($fd == $frame->fd) continue;
                $server->push($fd, $frame->data);
            }

        });

        // 连接关闭时回调函数
        $this->server->on('close', function ($server, $fd){
            echo "client {$fd} closed\n";
        });

        $this->server->start();
    }
}
