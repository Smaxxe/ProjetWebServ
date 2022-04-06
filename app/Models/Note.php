<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $guarded = [];
    use HasFactory;

    /*
    ** Récupère la série rattachée à la note
    */
    public function series(){
        return $this->belongsTo(Serie::class, 'serie_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
