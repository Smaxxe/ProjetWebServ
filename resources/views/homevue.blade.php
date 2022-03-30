{{-- C'est la vue d'acceuil de la version VueJS de l'aplication --}}


<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>FreshTomatoes | Welcome</title>
    <link rel="stylesheet" href="{{ URL::to('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.2.3/motion-ui.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation-prototype.min.css">
    <link href='https://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css' rel='stylesheet'
        type='text/css'>
</head>

<body>
    <div id="layout">
    </div>

    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/foundation.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.2.3/motion-ui.min.js"></script>
    {{-- <script src="{{ URL::to('/js/manifest.js') }}"></script>
    <script src="{{ URL::to('/js/vendor.js') }}"></script> --}}
    <script src="{{ URL::to('/js/app.js') }}"></script>
    <script>
        $(document).foundation();
    </script>


</body>

</html>
