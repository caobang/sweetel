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

class GroupController extends Controller
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
        //$parentid = $request->input('parentid',0);
        Group::create([
            //'parent_id' => $parentid,
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
        $group->fill(['name' => $groupname]);
        $group->save();
    }

    /**
     * 删除用户组.
     *
     * @return \Illuminate\Http\Response
     */
    public function delUserGroup(int $id)
    {
        $group = Group::find($id);
        $group->delete();
    }
}
