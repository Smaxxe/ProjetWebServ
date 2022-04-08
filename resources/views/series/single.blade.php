@extends('/layouts/main')

<!-- View d'affichage d'une série en particulier-->

@section('content')
    <h1>{{ $serie->title }}</h1>
    <h2 class='subheader'>Auteur de l'article : {{ $serie->author->name }}</h2>

    {{-- On vérifie que la série possède bien des médias pour éviter d'afficher un slider vide donc des morceaux sans image
    A FAIRE : régler pb url et remplacer la src par $media->url --}}
    @if (!$medias->isEmpty())
        {{-- Slider basé sur ce tuto :  https://www.w3schools.com/howto/howto_js_slideshow.asp --}}
        <div class="slideshow-container">

            @foreach ($medias as $media)
                <!-- Full-width images with number and caption text -->
                <div class="mySlides">
                    <div class="numbertext">{{ $loop->iteration }} / {{ $medias->count() }}</div>
                    <img src="/storage/medias/{{ $media->filename }}" style="width:100%">
                </div>
            @endforeach

            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <br>

        <!-- The dots/circles -->
        <div style="text-align:center">
            @for ($i = 1; $i <= $medias->count(); $i++)
                <span class="dot" onclick="currentSlide({{ $i }})"></span>
            @endfor
        </div>

        {{-- Code JS du slider, issu du même tuto --}}
        <script>
            var slideIndex = 1;
            showSlides(slideIndex);

            // Next/previous controls
            function plusSlides(n) {
                showSlides(slideIndex += n);
            }

            // Thumbnail image controls
            function currentSlide(n) {
                showSlides(slideIndex = n);
            }

            function showSlides(n) {
                var i;
                var slides = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("dot");
                if (n > slides.length) {
                    slideIndex = 1
                }
                if (n < 1) {
                    slideIndex = slides.length
                }
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex - 1].style.display = "block";
                dots[slideIndex - 1].className += " active";
            }
        </script>
    @endif

    {{-- Affichage du contenu de la série --}}
    <p>{{ $serie->content }}</p>

    <p style="color: grey; font-size: 12px">TAGS : {{ $serie->tags }}</p>

    <h4>Note :</h4>
    @if ($moyenne != 'none')
        {{$moyenne}}/10
    @else
        Pas encore de notes
    @endif
    {{-- Liste des commentaires --}}
    <h4> Commentaires :</h4>
    @foreach ($comments as $comment)
        {{$comment->content}} <br>
        <i>-{{$comment->author->name}}</i>
        <br><br>
    @endforeach

    {{-- Affichage d'erreurs si une donnée du formulaire n'est pas valide --}}
    @if ($errors->any()) {{--Si la validation renvoie une/des erreur(s), on affiche ici--}}
        <div class="" style="padding-top: 20px">
            <ul style="color:red">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Affichage d'un feedback après ajout de commentaire --}}
    @if(session('status'))
        <script>
            window.alert('{{session('status')}}')
        </script>
    @endif

    @auth
        {{-- Formulaire pour commentaire --}}
        <form method="POST" action="/comment?serie_id={{$serie->id}}">{{-- On met l'id de la série dans l'url pour pouvoir le récupérer dans la fonction store() --}}
            @csrf
            <div>
                @if ($commentaire == [])
                    <label for="content" style="font-size: 15pt">Ajouter un commentaire :</label>
                @else
                    <label for="content" style="font-size: 15pt">Modifier votre commentaire :</label>
                @endif
                {{-- Toute la balise textarea est sur une seule ligne pour éviter des espaces dans la box textarea qui apparaissent si on met le contenu à la ligne --}}
                <textarea name="content" id="content" style="resize: none" minlength="20" maxlength="1000" placeholder="Le commentaire doit faire entre 20 et 1000 caractères">@if ($commentaire != []){{$commentaire->content}}@endif</textarea>
            </div>
            <button type="submit" class="bouton-simple">Valider</button>
        </form>
        @if ($commentaire != [])
        {{-- Suppression du commentaire, c'est un formulaire sinon on ne peut pas utiliser la méthode delete --}}
        <form method="POST" action="/comment?serie_id={{$serie->id }}" style="margin-top: 20px;">
            @method("DELETE")
            @csrf
            <button type="submit" class="bouton-alerte">Supprimer le commentaire</button>
        </form>
        @endif

        {{-- Ajouter une note --}}
        <form method="POST" action="/note?serie_id={{$serie->id}}&user_id={{Auth::user()->id}}">
            @csrf
            <label for="content" style="font-size: 15pt">Donner une note :</label>
            @if ($note != [])
                <p>Vous avez donné la note {{$note->valeurNote}} à cette série. Vous pouvez la modifier si vous le souhaitez :</p>
            @else
                <p>Vous n'avez pas encore donné de note pour cette série.</p>
            @endif
            <p></p>
            <input type="radio" name="note" value="0">0
            <input type="radio" name="note" value="1">1
            <input type="radio" name="note" value="2">2
            <input type="radio" name="note" value="3">3
            <input type="radio" name="note" value="4">4
            <input type="radio" name="note" value="5">5
            <input type="radio" name="note" value="6">6
            <input type="radio" name="note" value="7">7
            <input type="radio" name="note" value="8">8
            <input type="radio" name="note" value="9">9
            <input type="radio" name="note" value="10">10 <br>
            <button type="submit" class="bouton-simple">Valider</button>
        </form>
    @else
        <a href="http://localhost:8000/login">Se connecter pour poster un commentaire</a>
    @endauth

@endsection
