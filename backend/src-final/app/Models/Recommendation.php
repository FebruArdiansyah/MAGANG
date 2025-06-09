<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    protected $fillable = ['berita_id', 'category_id'];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected static function booted()
    {
        static::creating(function ($recommendation) {
            if (!$recommendation->category_id && $recommendation->berita) {
                $recommendation->category_id = $recommendation->berita->category_id;
            }
        });

        static::updating(function ($recommendation) {
            if ($recommendation->berita) {
                $recommendation->category_id = $recommendation->berita->category_id;
            }
        });
    }
}
