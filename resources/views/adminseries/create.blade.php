@extends('/layouts/main')

@section('content')
    <h1>Création d'une nouvelle série</h1>

    @if ($errors->any())
        {{-- Si la validation renvoie une/des erreur(s), on affiche ici --}}
        <div class="" style="padding-top: 20px">
            <ul style="color:red">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulaire de création d'une série --}}
    <form method="POST" id="createSerie" action="/admin/series">
        @csrf
        <div>
            <label for="title" style="font-size: 15pt">Titre :</label>
            <textarea name="title" id="title" style="resize: none"></textarea>
        </div>
        <div> {{-- Ici le choix de l'auteur se fait via un menu de sélection déjà rempli par les auteurs existants --}}
            <label for="author" style="font-size: 15pt">Auteur : </label>
            <select name="author" id="author">
                <option value="">--Sélectionner un auteur--</option>
                @foreach ($authors as $author)
                    <option>{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="content" style="font-size: 15pt">Contenu :</label>
            <textarea name="content" id="content" style="height:300px;resize:none"></textarea>
        </div>
        <div>
            <label for="acteurs" style="font-size: 15pt">Acteurs :</label>
            <textarea name="acteurs" id="acteurs" style="resize: none;height:100px"></textarea>
        </div>
        <div>
            <label for="tags" style="font-size: 15pt">Tags :</label>
            <textarea name="tags" id="tags" style="resize: none;height:100px"></textarea>
        </div>

        <div class="form-group">
            <input type="file" name="files[]" id="files" placeholder="Choose files" multiple>
        </div>

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
                        url: "{{ url('admin/series') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: (data) => {
                            this.reset();
                            alert('Files has been uploaded using jQuery ajax');
                        },
                        error: function(data) {
                            alert(data.responseJSON.errors.files[0]);
                            console.log(data.responseJSON.errors);
                        }
                    });
                });
            });
        </script>

        <button type="submit"
            style="border: 1px solid black; border-color: black; padding:10px; font-size: 20px; top:5px">Créer</button>
    </form>

    <div style="margin-bottom: 5%;margin-top : 20px"> {{-- Pour retourner à l'index de adminséries facilement --}}
        <a href="/admin/series">Revenir à l'index des séries</a>
    </div>
@endsection
