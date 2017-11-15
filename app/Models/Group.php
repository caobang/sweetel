<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    /**
     * 需要被转换成日期的属性。
     *
     * @var array
     */
    //protected $dates = ['deleted_at'];

    /**
     * 不可被批量赋值的属性。
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'enabled', 'created_at', 'updated_at','grouptype','team_id'
    ];
}
