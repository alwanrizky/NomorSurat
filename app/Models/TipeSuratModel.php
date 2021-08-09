<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeSuratModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipe_surat',
        'alias',
    ];

    public function nomorSurat(){
        return $this->hasMany(nomorSurat::class,'id_tipe_surat','id');
    }

}
