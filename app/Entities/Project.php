<?php

namespace Dashboard\Entities;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['owner_id', 'client_id', 'name', 'description', 'progress', 'status', 'due_date'];
    
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
    
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
    public function notes()
    {
        return $this->hasMany(ProjectNote::class);
    }
    
    public function members()
    {
        return $this->belongsToMany(User::class, 'projects_members', 'project_id', 'member_id');
    }

    public function files()
    {
        return $this->hasMany(ProjectFile::class);
    }
    
    public function tasks()
    {
        return $this->hasMany(ProjectTask::class);
    }
}