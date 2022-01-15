<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'mapel',
        'rpp',
        'embed',
        'status'
    ];

    public function cek()
    {
        return $this->hasOne(Documents::class, 'id_document', 'id');
    }
}
