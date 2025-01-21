<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cd extends Model
{
    use HasFactory;

    protected $table = 'cds';


    public function songs()
    {
        return $this->hasMany(Song::class, 'cd_id');
    }
}
