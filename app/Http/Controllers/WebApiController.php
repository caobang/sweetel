<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;

class WebApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 获取menus.
     *
     * @return \Illuminate\Http\Response
     */
    public function getuserinfo()
    {
        $user = Auth::user();
        return $user;
    }

    /**
     * 获取menus.
     *
     * @return \Illuminate\Http\Response
     */
    public function getmenus()
    {
        $data = Menu::where('enabled', 1)->get();
        return $data;
    }

    /**
     * 更新用户状态.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateuserstatus(Request $request)
    {
        $status = $request->input('status',1);
        $user = Auth::user();
        $user->status = $status;
        $user->save();
    }
}
