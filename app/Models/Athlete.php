<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        "umur",
        'otot_kaki',
        'otot_lengan',
        'teknik',
        'prestasi'
    ];
}
