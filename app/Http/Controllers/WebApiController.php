<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Menu;
use App\Models\Group;
use App\Models\GroupUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

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

    /**
     * 获取用户组.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPagingUsers(Request $request)
    {
        $user = Auth::user();
        $size = $request->input('size',0);
        $name = $request->input('name');
        $groupid = $request->input('groupid',1);
        $orderby = $request->input('orderby');
        $sort = $request->input('sort');
        $data = DB::table('users')
            ->leftJoin('groupusers', 'groupusers.user_id', '=', 'users.id')
            ->leftJoin('groups', 'groups.id', '=', 'groupusers.group_id')
            ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
            ->where('users.deleted_at', null)
            ->where('groupusers.deleted_at', null)
            ->where('groups.deleted_at', null)
            ->where('roles.deleted_at', null)
            ->where('users.team_id', $user->team_id)
            ->where('users.name','like', '%'.$name.'%')
            ->where('groups.grouptype', 1)
            ->whereIn('groupusers.group_id', [$groupid])
            ->orderBy('users.'.$orderby, $sort)
            ->select('users.id', 'users.name', 'users.email', 'groups.name as groupname', 'roles.name as rolename', 'users.created_at')
            ->paginate($size);
        return ['total'=>$data->total(),'list'=>$data->items()];
    }

    /**
     * 编辑用户组.
     *
     * @return \Illuminate\Http\Response
     */
    public function addUser(Request $request)
    {
        $user = Auth::user();
        $name = $request->input('name');
        $email = $request->input('email');
        $usergroupid = $request->input('usergroupid');
        $roleid = $request->input('roleid');
        $user = Group::create(['name' => $name,
                        'email' => $email,
                        'password' => bcrypt('111111'),
                        'roleid' => $user->$roleid,
                        'team_id' => $user->team_id
                        ]);
        GroupUser::Create([
            'group_id' => $usergroupid,
            'user_id' => $user->id
        ]);
    }

    /**
     * 编辑用户组.
     *
     * @return \Illuminate\Http\Response
     */
    public function editUser(Request $request,int $id)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $usergroupid = $request->input('usergroupid');
        $roleid = $request->input('roleid');
        $user = User::find($id);
        $user->fill([
            'name' => $name,
            'email' => $email,
            'roleid' => $roleid
        ]);
        $user->save();
        GroupUser::updateOrCreate([
            'group_id' => $usergroupid,
            'user_id' => $id
        ]);
    }

    /**
     * 删除用户组.
     *
     * @return \Illuminate\Http\Response
     */
    public function delUser(int $id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
