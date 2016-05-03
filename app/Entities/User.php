<?php

namespace Dashboard\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function projects()
    {
        return $this->hasMany(Project::class, 'owner_id');
    }
    
    public function jobs()
    {
        return $this->belongsToMany(Project::class, 'projects_members', 'member_id', 'project_id');
    }
}
