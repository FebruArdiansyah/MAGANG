<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
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
        static::creating(function ($rekomendasi) {
            if (!$rekomendasi->category_id && $rekomendasi->berita) {
                $rekomendasi->category_id = $rekomendasi->berita->category_id;
            }
        });

        static::updating(function ($rekomendasi) {
            if ($rekomendasi->berita) {
                $rekomendasi->category_id = $rekomendasi->berita->category_id;
            }
        });
    }
}
