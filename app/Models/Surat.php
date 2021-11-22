<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_template_surat',
        'id_nomor_surat',
        'id_user',
        'key',
        'value'
    ];

    // id table ini, id table FK
    public function user(){
        return $this->belongTo(User::class, 'id','id_user');
    }

    // id table ini, id table FK
    public function templateSurat(){
        return $this->belongTo(TemplateSurat::class, 'id','id_template_surat');
    }

    // id table ini, id table FK
    public function nomorSurat(){
        return $this->belongTo(NomorSurat::class, 'id','id_nomor_surat');
    }
}
