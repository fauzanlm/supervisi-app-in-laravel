<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'id_supervisor',
        'mapel',
        'rpp',
        'embed',
        'status',
        'catatan'
    ];

    
}
