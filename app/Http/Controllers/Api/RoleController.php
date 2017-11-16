<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Menu;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RoleController extends Controller
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
     * 获取角色.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoles()
    {
        $user = Auth::user();
        return Role::whereIn('team_id', [0, $user->team_id])
            ->get();
    }

    /**
     * 添加角色.
     *
     * @return \Illuminate\Http\Response
     */
    public function addRole(Request $request)
    {
        $user = Auth::user();
        $rolename = $request->input('name');
        Role::create(['name' => $rolename,
                        'team_id' => $user->team_id
                    ]);
    }

    /**
     * 编辑角色.
     *
     * @return \Illuminate\Http\Response
     */
    public function editRole(Request $request,int $id)
    {
        $rolename = $request->input('name');
        $role = Role::find($id);
        if($role-> team_id > 0){
            $role->fill(['name' => $rolename]);
            $role->save();
        }
    }

    /**
     * 删除角色.
     *
     * @return \Illuminate\Http\Response
     */
    public function delRole(int $id)
    {
        $role = Role::find($id);
        if($role-> team_id > 0){
            $role->delete();
        }
    }
}
