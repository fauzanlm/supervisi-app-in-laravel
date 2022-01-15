<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'tanggal_supervisi',
        'jam_dari',
        'jam_sampai',
        'id_supervisor',
    ];

    public function target()
    {
        return $this->belongsTo(User::class, 'nip', 'nip');
    }

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'id_supervisor', 'nip');
    }

    public function doc()
    {
        return $this->belongsTo(Documents::class, 'nip', 'nip');
    }
}
