@extends('/layouts/main')

@section('content')
    <h1>Nous contacter !</h1>

    @if ($errors->any()) {{--Si la validation renvoie une erreur, on affiche ici--}}
    <div class="" style="padding-top: 20px">
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method='POST' action='/contact'> {{--Ici on est dans le formulaire de contact--}}
        @csrf
        <div>
            <input type="text" name="name" placeholder="Nom et Prénom" value="{{old('name')}}">
        </div>
        <div>
            <input type="text" name="email" placeholder="Email" value="{{old('email')}}">
        </div>
        <div>
            <textarea name="message" placeholder="Message" minlength="20" maxlength="1000" style="height:200px;resize:none">{{old('message')}}</textarea>
        </div>
        <div>
            <button type="submit" class="bouton-simple">Envoyer</button>
        </div>
    </form>

    @if(session('succes')) {{-- Quand on reçoit l'info que le formulaire est validé, on envoie une alerte contenant le message d'information --}}
        <script>
            window.alert('{{session('succes')}}')
        </script>
    @endif

@endsection
