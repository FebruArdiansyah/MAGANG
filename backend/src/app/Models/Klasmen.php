<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klasmen extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'team_id',
        'jumlah_pertandingan',
        'menang',
        'seri',
        'kalah',
        'selisih_gol',
        'poin',
    ];

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
