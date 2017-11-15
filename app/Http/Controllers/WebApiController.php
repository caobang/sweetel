<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\Group;
use Illuminate\Support\Facades\DB;

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
    public function getUserInfo()
    {
        $user = Auth::user();
        return $user;
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

    /**
     * 更新用户状态.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUserStatus(Request $request)
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
    public function getUserGroups()
    {
        $user = Auth::user();
        return Group::where('grouptype', 1)
            ->whereIn('team_id', [0, $user->team_id])
            ->get();
    }

    /**
     * 编辑用户组.
     *
     * @return \Illuminate\Http\Response
     */
    public function addUserGroup(Request $request)
    {
        $user = Auth::user();
        $groupname = $request->input('name');
        $parentid = $request->input('parentid',0);
        Group::create(['parent_id' => $parentid,
                        'grouptype' => 1,
                        'name' => $groupname,
                        'team_id' => $user->team_id
                        ]);
    }

    /**
     * 编辑用户组.
     *
     * @return \Illuminate\Http\Response
     */
    public function editUserGroup(Request $request,int $id)
    {
        $groupname = $request->input('name');
        $group = Group::find($id);
        if($group-> team_id > 0){
            $group->fill(['name' => $groupname]);
            $group->save();
        }
    }

    /**
     * 删除用户组.
     *
     * @return \Illuminate\Http\Response
     */
    public function delUserGroup(int $id)
    {
        $group = Group::find($id);
        if($group-> team_id > 0){
            $group->delete();
        }
    }
}
