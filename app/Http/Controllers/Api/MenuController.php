<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Menu;
use App\Models\Group;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class MenuController extends Controller
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
    public function getMenus()
    {
        $data = Menu::all();
        return $data;
    }
}
