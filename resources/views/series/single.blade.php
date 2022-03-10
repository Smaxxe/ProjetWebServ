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
        <style>
            * {
                box-sizing: border-box
            }

            /* Slideshow container */
            .slideshow-container {
                max-width: 1000px;
                position: relative;
                margin: auto;
            }

            /* Hide the images by default */
            .mySlides {
                display: none;
            }

            /* Next & previous buttons */
            .prev,
            .next {
                cursor: pointer;
                position: absolute;
                top: 50%;
                width: auto;
                margin-top: -22px;
                padding: 16px;
                color: white;
                font-weight: bold;
                font-size: 18px;
                transition: 0.6s ease;
                border-radius: 0 3px 3px 0;
                user-select: none;
            }

            /* Position the "next button" to the right */
            .next {
                right: 0;
                border-radius: 3px 0 0 3px;
            }

            /* On hover, add a black background color with a little bit see-through */
            .prev:hover,
            .next:hover {
                background-color: rgba(0, 0, 0, 0.8);
            }

            /* Number text (1/3 etc) */
            .numbertext {
                color: #f2f2f2;
                font-size: 12px;
                padding: 8px 12px;
                position: absolute;
                top: 0;
            }

            /* The dots/bullets/indicators */
            .dot {
                cursor: pointer;
                height: 15px;
                width: 15px;
                margin: 0 2px;
                background-color: #bbb;
                border-radius: 50%;
                display: inline-block;
                transition: background-color 0.6s ease;
            }

            .active,
            .dot:hover {
                background-color: #717171;
            }

            /* Fading animation */
            .fade {
                -webkit-animation-name: fade;
                -webkit-animation-duration: 1.5s;
                animation-name: fade;
                animation-duration: 1.5s;
            }

            @-webkit-keyframes fade {
                from {
                    opacity: .4
                }

                to {
                    opacity: 1
                }
            }

            @keyframes fade {
                from {
                    opacity: .4
                }

                to {
                    opacity: 1
                }
            }

        </style>
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
@endsection
