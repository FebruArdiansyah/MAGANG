<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['nama_liga', 'slug'];

    protected static function booted()
    {
        static::creating(function ($category) {
            $category->slug = Str::slug($category->nama_liga);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->nama_liga);
        });
    }

    public function beritas()
    {
        return $this->hasMany(Berita::class);
    }

    public function klasmen()
    {
        return $this->hasMany(Klasmen::class);
    }

    public function recommendation()
    {
        return $this->hasMany(Recommendation::class);
    }
}
