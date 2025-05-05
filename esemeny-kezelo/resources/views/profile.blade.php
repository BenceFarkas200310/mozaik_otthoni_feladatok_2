<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$user->name}} profilja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/badges.css')}}">
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
</head>
<body>
    @include('navbar')
    <div class="container mt-5">
        <h1 class="mb-5">{{$user->name}} profilja</h1>
        <h2>Adatok</h2>
        <div class="details">
            <ul>
                <li aria-label="Felhasználó neve">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                    </svg>
                    <b>{{$user->name}}</b>
                </li>
                <li aria-label="Felhasználó email címe">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                        <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z"/>
                        <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648m-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
                      </svg>
                      <b>{{$user->email}}</b>
                </li>
                <li>
                    Csatlakozott: <b>{{\Carbon\Carbon::parse($user->created_at)->format('Y-m-d')}}</b>
                </li>
            </ul>
        </div>
        <h2>{{$user->name}} által létrehozott események</h2>
        <div class="users-events">
            @if ($usersEvents->isEmpty())
                <center><h3 class="text-danger mt-5 mb-5">{{$user->name}} még nem hozott létre eseményt!</h3></center>
            @else
                <div class="main-galery js-flickity mt-5" data-flickity-options='{ "cellAlign": "center", "contain": true }'>
                    @foreach($usersEvents as $event)
                        <div class="galery-cell">
                            <x-event-card :event="$event"/>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <h2>Események, amin {{$user->name}} ott lesz</h2>

        <div class="users-interested">
            @if ($userInterested->isEmpty())
                <center><h3 class="text-danger mt-5 mb-5">Még nem jelezte hogy ott lesz bármelyik eseményen!</h3></center>
            @else
                <div class="main-galery js-flickity mt-5" data-flickity-options='{ "cellAlign": "center", "contain": true }'>
                    @foreach($userInterested as $event)
                        <div class="galery-cell">
                            <x-event-card :event="$event"/>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>