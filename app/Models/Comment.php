<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = []; //On précise qu'aucune des propriétés du modèle n'est protégée contre le mass assignement
    use HasFactory;

    public function series(){
        return $this->belongsTo(Serie::class, 'serie_id');
    }

    public function author(){
        return $this->belongsTo(User::class, 'author_id');
    }
}
