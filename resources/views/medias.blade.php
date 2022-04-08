@extends('/layouts/main')
{{-- Ici on est dans la view d'ajout de médias à une série nouvelle crééé. On lui a passé l'id de la série créée --}}
@section('content')
    <h1>Gestion des médias de la série <b>{{ $serie->title }} <i>(ID : {{ $serie->id }})</i></b></h1>

    <div style="border: solid 2px rgb(45, 45, 163);padding: 20px">
        <h3>Médias de la série</h3>
        {{-- Si le controller n'a passé aucun média, on affiche le message, sinon on affiche les médias --}}
        @if ($medias->isEmpty())
            <div>
                La série n'a encore aucun médias
            </div>
        @else
            <div>
                @foreach ($medias as $media)
                    <img src="/storage/medias/{{$media->filename}}" alt="">

                    {{-- Suppression du média --}}
                    <form method="POST" action="/admin/media/{{ $media->id }}" style="margin-top: 5px; margin-bottom : 15px">
                        @method("DELETE")
                        @csrf
                        <button type="submit"
                           class="bouton-alerte">Supprimer le média ci-dessus</button>
                    </form>
                @endforeach
            </div>
        @endif
    </div>

    <div style="border: solid 2px rgb(45, 45, 163);padding: 20px; margin-top : 5px">
        <h3>Ajout de nouveaux médias</h3>
        <form method="POST" action="/admin/media" id="createSerie">
            @csrf

            <div class="form-group">
                <input type="file" name="files[]" id="files" placeholder="Choose files" multiple>
            </div>

            {{-- Ici on va passer en caché l'id de la série qu'on avait envoyé à la vue pour l'utiliser dans le controller ensuite --}}
            <div>
                <input type="hidden" name="serie_id" id="serie_id" value="{{ $serie->id }}">
            </div>

            <div> <button type="submit"
                    class="bouton-simple">Charger
                    les médias</button>
            </div>
        </form>

        <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function(e) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#createSerie').submit(function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    let TotalFiles = $('#files')[0].files.length; //Total files
                    let files = $('#files')[0];
                    for (let i = 0; i < TotalFiles; i++) {
                        formData.append('files' + i, files.files[i]);
                    }
                    formData.append('TotalFiles', TotalFiles);

                    $.ajax({
                        type: 'POST',
                        url: "{{ url('admin/media') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: (data) => {
                            this.reset();
                            alert("Le(s) fichier(s) a bien été ajouté à la série, veuillez recharger la page pour qu'il(s) soi(en)t affichés");
                        },
                        error: function(data) {
                            alert(data.responseJSON.errors.files[0]);
                            console.log(data.responseJSON.errors);
                        }
                    });
                });
            });
        </script>

    </div>
    {{-- Ici on va renvoyer directement sur l'index des séries sans ajout de média --}}
    <form method="GET" action="/admin/series">
        <button type="submit"
            class="bouton-alerte">Revenir au
            menu / Passer cette étape
        </button>
    </form>

    @if (session('status'))
        {{-- Quand on reçoit une information concernant une action sur une série, on affiche une alerte contenant cette info --}}
        <script>
            window.alert('{{ session('status') }}')
        </script>
    @endif
@endsection
