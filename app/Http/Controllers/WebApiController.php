<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\Group;

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

    /**
     * 获取用户组.
     *
     * @return \Illuminate\Http\Response
     */
    public function getusergroups()
    {
        $user = Auth::user();
        $data = Group::where('grouptype', 1)
            ->whereIn('team_id', [0, $user->team_id])
            ->where('enabled', 1)
            ->get();
        return $data;
    }

    /**
     * 编辑用户组.
     *
     * @return \Illuminate\Http\Response
     */
    public function addusergroup()
    {
        $user = Auth::user();
        $groupname = $request->input('groupname');
        $parentid = $request->input('parentid');
        $group = Group::create(['parent_id' => $parentid,
                        'grouptype' => 1,
                        'name' => $groupname,
                        'team_id' => $user->team_id
                        ]);
        return $group->id;
    }

    /**
     * 编辑用户组.
     *
     * @return \Illuminate\Http\Response
     */
    public function editusergroup($id)
    {
        $groupname = $request->input('groupname');
        $group = Group::find($id);
        $group->name = $groupname;
        $group->save();
    }

    /**
     * 删除用户组.
     *
     * @return \Illuminate\Http\Response
     */
    public function delusergroup($id)
    {
        $group = Group::find($id);
        $group->enabled = 0;
        $group->save();
    }
}
