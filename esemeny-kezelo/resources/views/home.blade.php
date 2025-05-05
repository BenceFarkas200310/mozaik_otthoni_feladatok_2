<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OttLeszek!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/badges.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
</head>
<body>
    @include('navbar')
    <section class="title">
        <h1>OttLeszek!</h1>
        <h3>Biztos megtalálod, amit keresel!</h3>
        
        <a href="#public-events" id="scroller" aria-label="Tovább az eseményekhez">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-arrow-down-square-fill" viewBox="0 0 16 16">
                <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm6.5 4.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5a.5.5 0 0 1 1 0"/>
              </svg>
        </a>
        
    </section>

    <section id="public-events">
        <span id="title"><h2 class="mb-5">Legújabb publikus események</h2> <a href="all-events">Összes megtekintése ></a></span>

        <div class="main-galery js-flickity mt-5" data-flickity-options='{ "cellAlign": "left", "contain": true }'>
            @foreach($publics as $event)
                <div class="galery-cell">
                    <x-event-card :event="$event"/>
                </div>
            @endforeach
        </div>

        <span id="title" class="mt-5 pt-5">
            <h2 class="mb-5">Legújabb nem publikus események</h2>
            @if(!$privates->isEmpty())
                <a href="all-events">Összes megtekintése ></a>
            @endif
            </span>
        
            @if ($privates->isEmpty())
                <center><h2 class="mt-5 pb-5">Még nincs egy esemény sem, amire meg lettél hívva!</h2></center>
            @else
                <div class="main-galery js-flickity mt-5" data-flickity-options='{ "cellAlign": "left", "contain": true }'>
                    @foreach($privates as $event)
                        <div class="galery-cell">
                            <x-event-card :event="$event"/>
                        </div>
                    @endforeach
                </div>
            @endif        
        
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>