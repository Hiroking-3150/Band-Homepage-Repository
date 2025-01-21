<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cd;

class Song extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'cd_id'];

    public function cd()
    {
        return $this->belongsTo(Cd::class, 'cd_id');
    }

}
