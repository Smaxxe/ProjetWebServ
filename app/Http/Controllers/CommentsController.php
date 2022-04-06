<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'between:20,1000'],
        ]);
        //On récupère l'id de l'utilisateur connecté
        $author_id = Auth::user()->id;

        // On check si l'utilisateur a déjà donné un commentaire à cette série
        $comment = Comment::where('serie_id', request('serie_id'))->where('author_id', $author_id)->first();

        // Si c'est le cas, on modifie le contenu du commentaire:
        if ($comment != []){
            $comment->content = request('content');
            $comment->save();
        }
        /* Sinon, création d'un nouveau commentaire */
        else{
            $newComment = new Comment();
            $newComment->author_id = $author_id;
            $newComment->serie_id = request('serie_id');
            $newComment->content = request('content');
            $newComment->save();
        }

        //On revient sur la page de la série qu'on vient de commenter
        return back()->with('status', 'Votre commentaire a bien été pris en compte');
    }

    public function destroy(){
        $comment = Comment::where('serie_id', request('serie_id'))->where('author_id', Auth::user()->id)->first();
        $comment->delete();
        return back()->with('status', "Votre commentaire a bien été supprimé");
    }
}
