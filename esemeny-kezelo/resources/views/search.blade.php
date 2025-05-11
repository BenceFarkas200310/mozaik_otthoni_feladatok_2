<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Események keresése</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/card.css')}}">
    <link rel="stylesheet" href="{{asset('css/badges.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    @include('navbar')
    <div class="container mt-3">
        <h1 class="mb-4">Események keresése</h1>
        <p class="mb-4">Itt kereshetsz események között név, helyszín, dátum vagy típus alapján.</p>
        <input type="text" id="searchBar" class="form-control mb-4" placeholder="Kezdj el gépelni...">

        <div id="eventResults" class="row">
            @foreach ($events as $event)
                <div class=" col-12 col-md-6 col-lg-4 mb-3 event-card d-flex justify-content-center" data-name="{{ $event->name }}" data-location="{{ $event->location }}" data-date="{{ $event->date }}" data-type="{{ $event->type }}">
                    
                    <x-event-card :event="$event" />
                </div>
            @endforeach
        </div>
    </div>

     <script>
        $(document).ready(function() {
            $('#searchBar').on('input', function() {
                let query = $(this).val().toLowerCase();

                $('.event-card').each(function() {
                    let name = $(this).data('name').toLowerCase();
                    let location = $(this).data('location').toLowerCase();
                    let date = $(this).data('date').toLowerCase();
                    let type = $(this).data('type').toLowerCase();

                    if (name.includes(query) || location.includes(query) || date.includes(query) || type.includes(query)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>