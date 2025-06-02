<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function berita()
    {
        return $this->hasMany(Berita::class);
    }

    public function klasmen()
    {
        return $this->hasMany(Klasmen::class);
    }
}
