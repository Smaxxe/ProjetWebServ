<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $guarded=[];
    /**
    * Récupère la série à laquelle le média est attaché
    */
    public function serie(){
        return $this->belongsTo(Serie::class, 'serie_id');
    }
}
