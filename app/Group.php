<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Group extends Model
{
    use Notifiable;

    protected $table = 'groups';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'id',
    ];


    //relazione molti a molti con User
    public function userRel()
    {
        return $this->belongsToMany('App\User','users_groups', 'user_id', 'group_id');
    }


}
