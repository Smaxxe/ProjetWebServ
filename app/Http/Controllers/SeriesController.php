<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Serie;
use Illuminate\Http\Request;
use \App\Models\Media;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class SeriesController extends Controller
{
    public function index(){
        $series = Serie::all();
        return view('series.index', array('series' => $series));
    }

    public function show($serie_url){
        $serie = \App\Models\Serie::where('url', $serie_url)->first();
        $comments = $serie->comments;
        $medias = $serie->medias;
        $notes = $serie->notes;

        // $data est le tableau de données qu'on va encoyer à la vue ($moyenne veut none, il sera écrasé par la suite
        // si la série a des notes)
        $data = array('serie' => $serie, 'comments' => $comments,'medias' => $medias, 'moyenne' => 'none');

        if (!$notes->isEmpty()){
            // Calcul de la moyenne des notes
            $total=0;
            $nbNotes=0;
            foreach($notes as $note){
                $total = $total + $note->valeurNote;
                $nbNotes = $nbNotes + 1;
            }
            $moyenne = round($total / $nbNotes, 1);
            //on ajoute la moyenne aux données envoyées à la vue
            $data['moyenne'] = $moyenne;
        }

        // Si un utilisateur est connecté, on récupére le commentaire et la note que cet
        // utilisateur a donnés pour cette série (peuvent être vides), et ils sont mis dans $data
        if(Auth::check()){
            $author_id = Auth::user()->id;
            $comment = Comment::where('serie_id', $serie->id)->where('author_id', $author_id)->first();
            $data['commentaire'] = $comment;
            $note = Note::where('serie_id', $serie->id)->where('user_id', $author_id)->first();
            $data['note'] = $note;
        }

        return view('series.single', $data);
    }
}
