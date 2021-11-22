<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nama_surat',
        'id_user',
    ];

    public function tipeSurat(){
        return $this->belongTo(User::class, 'id','id_user');
    }

    // id table FK, id table ini
    public function atrSurat(){
        return $this->hasMany(AtrSurat::class,'id_atr_surat','id');
    }

    public function surat(){
        return $this->hasMany(Surat::class,'id_template_surat','id');
    }
}
