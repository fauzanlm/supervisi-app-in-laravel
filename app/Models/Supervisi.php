<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nip',
        'id_supervisor',
        'id_jadwal',
        'id_document',
        'rpp_status',
        'video_status',
        'catatan',
    ];
}
