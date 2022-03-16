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
                <div class="mySlides fade">
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

{{-- Formulaire pour commentaire --}}
@auth
    <form method="POST" action="/comment?serie_id={{$serie->id}}">{{-- On met l'id de la série dans l'url pour pouvoir le récupérer dans la fonction store() --}}
        @csrf
        <div>
            <label for="content" style="font-size: 15pt">Ajouter commentaire :</label>
            <textarea name="content" id="content" style="resize: none" placeholder="Le commentaire doit faire entre 20 et 1000 caractères"></textarea>
        </div>
        <button type="submit" class="bouton-simple">Valider</button>
    </form>
@else
    <a href="http://localhost:8000/login">Se connecter pour poster un commentaire</a>
@endauth

@endsection
