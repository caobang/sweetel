<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'teamname' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $uid = DB::transaction(function ()use ($data) {
            $teamid = DB::table('teams')->insertGetId([
                'name' => $data['teamname'],
                'created_at' => new Carbon
            ]);
            DB::table('robots')->insert([
                'nickname' => '客服机器人',
                'team_id' => $teamid,
                'created_at' => new Carbon
            ]);
            $usergroupid = DB::table('groups')->insertGetId([
                'name' => '默认分组',
                'grouptype' => 1,
                'team_id' => $teamid
            ]);
            $chatgroupid = DB::table('groups')->insertGetId([
                'name' => '默认分组',
                'grouptype' => 2,
                'team_id' => $teamid
            ]);
            DB::table('groups')->insert([
                'name' => '默认分类',
                'grouptype' => 3,
                'team_id' => $teamid
            ]);
            DB::table('groups')->insert([
                'name' => '默认分组',
                'grouptype' => 4,
                'team_id' => $teamid
            ]);
            DB::table('groups')->insert([
                'name' => '默认分类',
                'grouptype' => 5,
                'team_id' => $teamid
            ]);
            $userid = DB::table('users')->insertGetId([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'team_id' => $teamid,
                'role_id' => 1,
                'group_id' => $usergroupid,
                //'chatgroup_id' => 2,
                'created_at' => new Carbon
            ]);
            
            DB::table('chatgroupusers')->insert([
                'group_id' => $chatgroupid,
                'user_id' => $userid
            ]);
            return $userid;
        });
        return User::find($uid);
    }
}
