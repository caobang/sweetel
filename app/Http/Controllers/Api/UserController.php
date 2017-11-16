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

class UserController extends Controller
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
     * 获取用户信息.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserInfo()
    {
        $user = Auth::user();
        return $user;
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
    public function getPagingUsers(Request $request)
    {
        $user = Auth::user();
        $size = $request->input('size',0);
        $name = $request->input('name');
        $usergroupid = $request->input('usergroupid',0);
        $orderby = $request->input('orderby');
        $sort = $request->input('sort');
        $data = DB::table('users')
            ->leftJoin('groups', 'groups.id', '=', 'users.usergroup_id')
            ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
            ->where('users.deleted_at', null)
            //->where('groups.deleted_at', null)
            //->where('roles.deleted_at', null)
            ->where('users.team_id', $user->team_id)
            ->where('users.name','like', '%'.$name.'%')
            ->where('groups.grouptype', 1)
            ->when($usergroupid>0, function ($query) use ($usergroupid) {
                return $query->where('users.usergroup_id', $usergroupid);
            })
            ->orderBy('users.'.$orderby, $sort)
            ->select('users.id', 'users.name', 'users.email', 'users.usergroup_id', 'groups.name as groupname', 'users.role_id', 'roles.name as rolename', 'users.created_at')
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
        $user = User::create(['name' => $name,
                        'email' => $email,
                        'password' => bcrypt('111111'),
                        'role_id' => $roleid,
                        'team_id' => $user->team_id,
                        'usergroup_id' => $usergroupid,
                        'chatgroup_id' => 2
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
            'roleid' => $roleid,
            'usergroup_id' => $usergroupid,
        ]);
        $user->save();
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
