<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Recommendation;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',
        'judul',
        'credit_foto',
        'deskripsi',
        'gambar',
        'status',
        'tanggal_publish',
        'views',
    ];

    // Relasi ke kategori liga
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke penulis
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel rekomendasi
    public function recommendation()
    {
        return $this->hasOne(Recommendation::class);
    }
}
