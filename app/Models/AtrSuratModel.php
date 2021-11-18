<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtrSuratModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'tipe',
        'id_template_surat'
    ];

    public function atrSurat(){
        return $this->belongTo(TemplateSuratModel::class, 'id','id_template_surat');
    }
    
}
