<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        'judul',
        'slug',
        'credit_foto',
        'deskripsi',
        'gambar',
        'status',
        'tanggal_publish',
        'views',
        'is_utama',
        'is_sorotan',
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
    ];

    protected static function booted()
    {
        static::saving(function (Berita $berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul);
            }
        });
    }

    /**
     * Bind route via slug, bukan ID.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /* ---------------------- Relations --------------------- */

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rekomendasis()
    {
        return $this->hasMany(Rekomendasi::class);
    }

    /* ----------------------- Scopes ----------------------- */

    public function scopePublished($query)
{
    return $query->where('status', 'publikasi')
                 ->whereNotNull('tanggal_publish')
                 ->where('tanggal_publish', '<=', now()->addMinutes(1)); // toleransi 1 menit
}


    public function scopeLatestFirst($query)
    {
        return $query->orderByDesc('tanggal_publish')
                     ->orderByDesc('created_at');
    }
}
