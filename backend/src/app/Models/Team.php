<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function klasmen()
    {
        return $this->hasMany(Klasmen::class);
    }
}
