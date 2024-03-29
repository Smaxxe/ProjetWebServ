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


    /**
    * Récupère les médias rattachés à cette série
    */
    public function medias(){
        return $this->hasMany(Media::class);
    }
    /**
    * Récupère les commentaires rattachés à cette série
    */
    public function comments(){
        return $this->hasMany(Comment::class, 'serie_id');
    }
    /**
     * Récupère les notes rattachées à la série
     */
    public function notes(){
        return $this->hasMany(Note::class, 'serie_id');
    }
}
