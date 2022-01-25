<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    // ];

    public function projects() {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function users() {
        return $this->belongsTo(User::class);
    }
}
