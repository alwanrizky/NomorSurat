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
    ];

    public function user(){
        return $this->belongTo(User::class, 'id','id_user');
    }
}
