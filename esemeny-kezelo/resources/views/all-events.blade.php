<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Összes publikus esemény</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/card.css')}}">
    <link rel="stylesheet" href="{{asset('css/badges.css')}}">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
</head>
<body>
    @include('navbar')
        <div class="container">
            <h1 class="mt-5 mb-5">Összes esemény</h1>

            <center>
                <button class="btn btn-primary m-2" id="publics-btn" onclick="showPublics()">Publikus események</button>
                <button class="btn btn-outline-primary m-2" id="privates-btn" onclick="showPrivates()">Privát események</button>
            </center>
            <div class="container row mt-5" id="publics">
                @foreach($publics as $event)
                    <div class="col-12 col-md-6 mb-3 d-flex justify-content-center">
                        <x-event-card :event="$event"/>
                    </div>
                @endforeach
            </div>

            <div class="container row hidden" id="privates">
                @if($privates->isEmpty())
                    <center><h2 class="mt-5 pb-5">Még nincs egy esemény sem, amire meg lettél hívva!</h2></center>
                @else
                    
                        @foreach($privates as $event)
                            <div class="col-12 col-md-6 mb-3">
                                <x-event-card :event="$event"/>
                            </div>
                        @endforeach
                    
                @endif
            </div>
        </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{asset('js/all-events.js')}}"></script>
        
    </script>
</body>
</html>