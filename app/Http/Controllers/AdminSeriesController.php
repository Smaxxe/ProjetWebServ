<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use App\Models\User;
use Illuminate\Http\Request;

class AdminSeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = \App\Models\Serie::all();
        return view('adminseries.index', array('series' => $series));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = \App\Models\User::all(); //On récupère tous les auteurs pour les passer à la view et remplir le menu de choix de l'auteur
        return view('adminseries.create', array('authors' => $authors));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validations : pas besoin de vérifier l'auteur puisque le choix se fait déjà parmi les users existants
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required', //On vérifie quand même que le champ ait un contenu pour éviter les fausses manips
            'content' => 'required',
            'acteurs' => 'required', //Si aucun acteur dans le film (animation par ex) il faut le préciser
            'tags' => 'required',

        ]);

        //Création de la nouvelle série avec les éléments
        $serie = new Serie();
        $serie->title = request('title');
        $serie->author_id = User::where('name', request('author'))->first()->id;
        $serie->content = request('content');
        $serie->acteurs = request('acteurs');
        $serie->tags = request('tags');
        $serie->url = str_replace(' ', '_', request('title'));
        $serie->status = 'published';
        $serie->save();

        //On envoie vers la vue d'ajout de médias, avec l'id de la série pour lier les médias à celle-ci
        return redirect("/admin/media/create/$serie->id")->with('status',"La série $serie->title (ID : $serie->id) a bien été créée !");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function show(Serie $serie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Serie  $series
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $series) //Dans ce controller le nom de variable $serie a été passé à $series pour correspondre au nom de paramètre attendu dans les routes
    {
        $authors = \App\Models\User::all(); //On récupère tous les auteurs pour les passer à la view et remplir le menu de choix de l'auteur
        return view('adminseries.edit', array('serie' => $series), array('authors' => $authors));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Serie  $series
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Serie $series)
    {
        //Validations : pas besoin de vérifier l'auteur puisque le choix se fait déjà parmi les users existants
        $validated = $request->validate([
            'title' => 'required',
            'author' => 'required', //On vérifie quand même que le champ ait un contenu pour éviter les fausses manips
            'content' => 'required',
            'acteurs' => 'required', //Si aucun acteur dans le film (animation par ex) il faut le préciser
            'tags' => 'required',

        ]);

        $series->update([ //On met à jour le contenu de la série
            'title' => request('title'),
            'author_id' => User::where('name', request('author'))->first()->id,
            'content' => request('content'),
            'acteurs' => request('acteurs'),
            'tags' => request('tags')
        ]);

        return redirect('/admin/series')->with('status', "La série $series->title (ID : $series->id) a bien été mise à jour");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Serie  $series
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $series)
    {
        $title = $series->title;
        $id = $series->id;
        $series->delete();
        return redirect('admin/series')->with('status', "La série $title (ID : $id) a bien été supprimée");
    }
}
