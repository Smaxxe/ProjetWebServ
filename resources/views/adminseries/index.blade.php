@extends('/layouts/main')

{{-- On est dans l'index de /admin/series qui va nous permettre de créer une série ou d'accéder à la page de modification d'une série existante--}}

@section('content')
    <h1>Gérer les séries :</h1>
    <div> {{--Partie pour aller vers la view de création d'une nouvelle série--}}
        <a href="/admin/series/create">
            <button class="bouton-simple">Créer une nouvelle série</button>
        </a>
    </div>
    <br>
    <ul>
        @foreach ($series as $serie)
            <li> {{--Partie pour aller vers la view d'édition/suppression d'une série de la liste--}}
                <a href='/admin/series/{{$serie->id}}/edit'>{{$serie->title}}</a>
            </li>
        @endforeach
    </ul>

    @if(session('status')) {{-- Quand on reçoit une information concernant une action sur une série, on affiche une alerte contenant cette info --}}
        <script>
            window.alert('{{session('status')}}')
        </script>
    @endif
@endsection
