<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtrSurat extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'tipe',
        'id_template_surat'
    ];

    public function atrSurat(){
        return $this->belongTo(TemplateSurat::class, 'id','id_template_surat');
    }
    
}
