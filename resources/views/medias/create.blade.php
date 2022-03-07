@extends('/layouts/main')
{{-- Ici on est dans la view d'ajout de médias à une série nouvelle crééé. On lui a passé l'id de la série créée --}}
@section('content')
    <h1>Ajouter des médias à la série créée ?</h1>
    <div>Test du passage de la série {{ $serie->id }}</div>
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
                style="border: 2px solid black; border-color: black; padding:8px; font-size: 15px; font-weight:bold; top:5px ">Charger
                les médias</button>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
                        alert('Le(s) fichier(s) a bien été ajouté à la série');
                    },
                    error: function(data) {
                        alert(data.responseJSON.errors.files[0]);
                        console.log(data.responseJSON.errors);
                    }
                });
            });
        });
    </script>
    {{-- Ici on va renvoyer directement sur l'index des séries sans ajout de média --}}
    <form method="GET" action="/admin/series">
        <button type="submit"
            style="color:red ; border: 3px;border-style:solid; padding:6px; font-weight:bold; margin-top : 20px">Revenir au menu / Passer cette étape
        </button>
    </form>

    @if (session('status'))
        {{-- Quand on reçoit une information concernant une action sur une série, on affiche une alerte contenant cette info --}}
        <script>
            window.alert('{{ session('status') }}')
        </script>
    @endif
@endsection
