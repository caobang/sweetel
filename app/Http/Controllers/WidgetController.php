<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
