<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function projects(){
        return $this->belongsToMany(Project::class, 'project_teams', 'user_id', 'project_id')
            ->withTimestamps()
            ->withPivot(['role', 'project_id', 'user_id']);
    }

    public function projectRole($role, $project, $user) {
        if($this->projects()->wherePivot('role', $role)->wherePivot('project_id', $project)->wherePivot('user_id', $user)->first()){
            return true;
        }else{
            return false;
        }
    }

    public function task(){
        return $this->hasMany(Task::class);
    }
}
