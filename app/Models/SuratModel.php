<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'kepada',
        'perihal',
        'tanggal',
        'id_user',
        'id_tipe_surat'
    ];

    // id table ini, id table FK
    public function user(){
        return $this->belongTo(User::class, 'id','id_user');
    }

    // id table ini, id table FK
    public function tipeSurat(){
        return $this->belongTo(User::class, 'id','id_tipe_surat');
    }
}
