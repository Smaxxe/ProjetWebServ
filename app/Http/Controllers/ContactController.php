<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //Renvoie la view d'accueil pour le contact, donc le formulaire de contact
    public function index(){
        return view('contact');
    }

    //Crée une nouvelle entrée dans la DB correspondant à un envoi de formulaire de contact
    public function store(Request $request){

        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email:rfc,dns'],
            'message'=> ['required', 'string', 'between:20,1000'],

        ]);
        /* Si on arrive ici, c'est qu'aucune des règles au-dessus n'a été violée.
        Sinon on est renvoyé vers la dernière page (/contact) avec la variable $errors mise à jour qu'on peut alors exploiter
        dans le html pour donner des feedbacks */

        /*---Création d'un nouveau contact----*/
        Contact::create(request(['name','email','message']));

        /* redirection vers /contact (en get) avec des donnees flash dans la session
        pour donner un feedback positif (cf https://laravel.com/docs/9.x/redirects#redirecting-with-flashed-session-data) */
        return redirect('/contact')->with('succes', 'Votre demande de contact a bien été reçue !');
    }
}
