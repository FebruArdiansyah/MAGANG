<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Klasmen extends Model
{
    protected $fillable = [
        'category_id', 'team_id', 'jumlah_pertandingan',
        'menang', 'seri', 'kalah', 'selisih_gol', 'poin'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
