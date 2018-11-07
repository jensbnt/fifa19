<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <link rel="shortcut icon" type="image/png"
          href="https://lh3.googleusercontent.com/0OkazSaeKunzFw09BhD2zdEdOeavQcT9ejfkq1jl9fgTeuIjL6OMGnQvq-rrhxtpsCM=s180-rw"/>

    @if(Cookie::has('nightmode') && Cookie::get('nightmode'))
        <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css">
    @else
        <link rel="stylesheet" href="https://bootswatch.com/4/flatly/bootstrap.min.css">
    @endif
    <link rel="stylesheet" href="{{ URL::to('css/app.css') }}">

    <title>FIFA 19</title>
</head>
<body>
@include('partials.header')
@yield('content')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
@include('partials.footer')
</html>
