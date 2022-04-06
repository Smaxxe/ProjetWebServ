<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function storeOrUpdate(Request $request){
        $validated = $request->validate([
            'note' => 'required',
        ]);
        $note = Note::where('serie_id', request('serie_id'))->where('user_id', request('user_id'))->first();

        //On check si l'utilisateur a déjà donné une note à cette série
        // Si c'est le cas, on modifie la valeur de la note :
        if ($note != []){
            $note->valeurNote = request('note');
            $note->save();
        }
        // sinon, on crée une nouvelle note:
        else{
            $nouvelleNote = new Note();
            $nouvelleNote->serie_id = request('serie_id');
            $nouvelleNote->user_id = request('user_id');
            $nouvelleNote->valeurNote = request('note');
            $nouvelleNote->save();
        }
        return back()->with('status', 'Votre note a bien été prise en compte');
    }
}
