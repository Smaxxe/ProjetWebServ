<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;


class ContactAPI extends Controller
{
    /* Store un nouveau contact dans la base de données*/
    public function store(Request $request){

        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email:rfc,dns'],
            'message'=> ['required', 'string', 'between:20,1000'],

        ]);
        /* Si on arrive ici, c'est qu'aucune des règles au-dessus n'a été violée. */

        /*---Création d'un nouveau contact----*/
        $contact = Contact::create(request(['name','email','message']));

        return $contact;
    }
}
