<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeSurat extends Model
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
        'id_user',
    ];

    // id table FK, id table ini
    public function nomorSurat(){
        return $this->hasMany(nomorSurat::class,'id_tipe_surat','id');
    }

    public function user(){
        return $this->belongTo(User::class, 'id','id_user');
    }
}
