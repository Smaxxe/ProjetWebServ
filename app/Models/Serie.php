<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $guarded = []; //On précise qu'aucune des propriétés du modèle n'est protégée contre le mass assignement
    use HasFactory;

    /**
    * Get the user that authored the serie.
    */
    public function author(){
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'serie_id');
    }
}
