<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $event->name }} - Esemény részletei</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/badges.css')}}">
    <link rel="stylesheet" href="{{asset('css/details.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    @include('navbar')
    <div class="mt-2">
        <center>
            <div class="image-container">
                <img src="{{asset('placeholder.jpg')}}" alt="Esemény fotója">
                <h1>{{$event->name}}</h1>
            </div>
        </center>
    </div>
    <div class="container mb-5 row" id="details-container">
        <h2 class="mb-3">Részletek:</h2>
        <div class="col-12 col-sm-6">
           <x-badge :event="$event" />
            <ul>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                    {{$event->location}}
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                    </svg>
                    {{$event->date}}
                </li>
            </ul>
        </div>
        <div class="col-12 col-sm-6 right-side">
            Szervező: <br>
            <b><p class="mb-5">{{$event->author->name}}</p></b>
            @if (Auth::check() && !$isInterested)
                <button class="btn btn-primary" id="interestedButton">Ott leszek!</button>
            @elseif (Auth::check() && $isInterested)
                <button class="btn btn-primary disabled">Jelentkeztél!</button>
            @else
                <button class="btn btn-primary disabled">Ott leszek!</button>
                <p class="error">Jelentkezz be, hogy jelentkezni tudj az eseményre!</p>
            @endif
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <script>
        $(document).ready(function() {
            $('#interestedButton').click(function() {
                $.ajax({
                    url: '{{ url('/event/interested') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        event_id: '{{ $event->id }}'
                    },
                    success: function(response) {
                        alert('Jelentkeztél az esményre!');
                        $('#interestedButton').text('Jelentkeztél!').prop('disabled', true);
                    },
                    error: function(xhr) {
                        alert('Hiba! :(');
                    }
                });
            });
        });
    </script>
</body>
</html>
