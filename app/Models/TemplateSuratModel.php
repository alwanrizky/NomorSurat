<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSuratModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_surat',
        'id_user',
    ];

    public function tipeSurat(){
        return $this->belongTo(User::class, 'id','id_user');
    }

    // id table FK, id table ini
    public function atrSurat(){
        return $this->hasMany(AtrSuratModel::class,'id_atr_surat','id');
    }
}
