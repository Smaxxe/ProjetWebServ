<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $guarded = []; //On précise qu'aucune des propriétés du modèle n'est protégée contre le mass assignement
    use HasFactory;
}
