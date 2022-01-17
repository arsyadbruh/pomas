<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestOption extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'test_options';

    use HasFactory;

    public function test() {
        return $this->hasMany(Test::class);
    }
}
