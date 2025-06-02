<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rekomendasi extends Model
{
    use HasFactory;

    protected $fillable = ['berita_id'];

    public function berita()
    {
        return $this->belongsTo(Berita::class);
    }
}
