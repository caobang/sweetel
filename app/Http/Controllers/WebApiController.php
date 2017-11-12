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
        $data = Auth::user();
        return $data;
    }

    /**
     * 获取menus.
     *
     * @return \Illuminate\Http\Response
     */
    public function getmenus()
    {
        $uid = Auth::id();
        $data = Menu::where('enabled', 1)->get();
        return $data;
    }
}
