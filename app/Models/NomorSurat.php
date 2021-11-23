<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NomorSurat extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nomor_surat',
        'kepada',
        'perihal',
        'id_user',
        'id_tipe_surat',
        'surat_created'
    ];

    // id table ini, id table FK
    public function user(){
        return $this->belongTo(User::class, 'id','id_user');
    }

    // id table ini, id table FK
    public function tipeSurat(){
        return $this->belongTo(User::class, 'id','id_tipe_surat');
    }

    public function surat(){
        return $this->hasMany(NomorSurat::class,'id_nomor_surat','id');
    }
}
