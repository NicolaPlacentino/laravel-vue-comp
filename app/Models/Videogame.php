<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videogame extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'title',
        'platform',
        'publisher',
        'genre',
        'image_url',
        'description',
        'release_date',
        'weight'
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/y H:i',
        'updated_at' => 'datetime:d/m/y H:i:s',
    ];


    // videogames
    // public function videogames()
    // {
    //     return $this->belongsTo(Videogame::class);
    // }
}
