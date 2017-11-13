<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

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
    protected $redirectTo = '/home';

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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        DB::table('teams')->insertGetId([
            'name' => 'dd'
        ]);
        DB::table('users')->insertGetId([
            'name' => 'sf',
            'email' => 'df',
            'password' => 'er',
            'team_id' => 1,
            'role_id' => 1
        ]);
        return User::find(1);

        DB::transaction(function () {
            /*$teamid = DB::table('teams')->insertGetId([
                'name' => $data['teamname']
            ]);
            DB::table('robots')->insert([
                'nickname' => '小甜机器人',
                'team_id' => $teamid
            ]);*/
            $userid = DB::table('users')->insertGetId([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'team_id' => 1,
                'role_id' => 1
            ]);
            /*DB::table('groupusers')->insert([
                'group_id' => 1,
                'user_id' => $userid
            ]);
            DB::table('groupusers')->insert([
                'group_id' => 2,
                'user_id' => $userid
            ]);*/
        });

    }
}
