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
    <div class="container mb-5 row gap-0 column-gap-3" id="details-container">
        <h2 class="mb-3">Részletek:</h2>
        <div class="col-12 col-sm-6">
           <x-badge :event="$event" />
            <ul>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg>
                    <b>{{$event->location}}</b>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
                    </svg>
                    <b>{{\Carbon\Carbon::parse($event->date)->format('Y-m-d H:i')}}</b>
                </li>
                <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
                      </svg>
                    <b id="interestedCount">{{$howManyInterested}}</b> ember jelezte, hogy ott lesz.
                </li>
            </ul>
        </div>
        
        <div class="col-12 col-sm-6 right-side">
            Szervező: <br>
            <b><a href="/profile/{{$event->author_id}}"><p class="mb-5">{{$event->author->name}}</p></a></b>
            @if (Auth::check() && !$isInterested)
                <button class="btn btn-primary" id="interestedButton">Ott leszek!</button>
            @elseif (Auth::check() && $isInterested)
                <button class="btn btn-primary disabled">Jelentkeztél!</button>
            @else
                <button class="btn btn-primary disabled">Ott leszek!</button>
                <p class="error">Jelentkezz be, hogy jelentkezni tudj az eseményre!</p>
            @endif
        </div>
        <h2 class="mb-3 mt-5">Leírás:</h2>
        <p>{{$event->description}}</p>
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
                        let currentCount = parseInt($('#interestedCount').text());
                        $('#interestedCount').text(currentCount + 1);
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
