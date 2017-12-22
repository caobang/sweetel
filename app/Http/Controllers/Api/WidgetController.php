<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;

class WidgetController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * 获取menus.
     *
     * @return \Illuminate\Http\Response
     */
    //Request $request
    public function getConfig(int $tid)
    {
        //$tid = $request->input('tid');
        $data['tid'] = $tid;
        $data['themecolor'] = "#13C9CB";
        return $data;
    }


    /**
     * 获取menus.
     *
     * @return \Illuminate\Http\Response
     */
    //Request $request
    public function connection(Request $request)
    {
        $socketid = $request->input('socketid');
        $data['chatid'] = 1;
        return $data;
    }


    /**
     * 获取menus.
     *
     * @return \Illuminate\Http\Response
     */
    //Request $request
    public function sendMessage(Request $request)
    {
        $chatid = $request->input('chatid');
        $socketid = $request->input('socketid');
        $content = $request->input('content');
        Redis::publish('chat.2', json_encode(['socketid' => $socketid,'content' => $content]));
    }
}
