<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'user_id',
        'judul',
        'credit_foto',
        'slug',
        'deskripsi',
        'gambar',
        'status',
        'tanggal_publish',
    ];

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
