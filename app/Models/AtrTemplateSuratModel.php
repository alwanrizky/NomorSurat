<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtrTemplateSuratModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_template_surat',
        'id_atr_surat',
    ];
}
