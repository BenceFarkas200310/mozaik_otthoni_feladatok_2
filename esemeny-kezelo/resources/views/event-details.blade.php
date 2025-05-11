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
                <img src="{{asset($event->thumbnail ?? 'placeholder.jpg')}}" alt="Esemény fotója">
                <h1>{{$event->name}}</h1>
            </div>
        </center>
    </div>
    <div class="container mb-5 row gap-0 column-gap-3" id="details-container">
        <div class="title">
            <h2 class="mb-3">Részletek:
            </h2>
            <span onclick="toggleEdit()" id="edit-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z"/>
                </svg>    
            </span>
        </div>
        
        <!--Esemény módosítása-->

        <div class="col-12 col-sm-6">
            <form id="update-event-form">
                @csrf
                <div class="mb-3">
                    <label for="event-name" class="form-label">Esemény neve</label>
                    <input type="text" class="form-control" id="event-name" name="event-name">
                    <div class="error" id="event-name-error"></div>
                </div>
                <div class="mb-3">
                    <label for="event-type" class="form-label">Esemény típusa</label>
                    <select type="text" class="form-select" id="event-type" name="event-type">
                        <option value="">Válassz típust!</option>
                        <option value="koncert">koncert</option>
                        <option value="konferencia">konferencia</option>
                        <option value="dedikálás">dedikálás</option>
                        <option value="sport">sport</option>
                        <option value="expo">expo</option>
                        <option value="egyéb">egyéb</option>
                    </select>
                    <div class="error" id="event-type-error"></div>
                </div>
                <div class="mb-3">
                    <label for="event-location" class="form-label">Esemény helyszíne</label>
                    <input type="text" class="form-control" id="event-location" name="event-location">
                    <div class="error" id="event-location-error"></div>
                </div>
                <div class="mb-3">
                    <label for="event-date" class="form-label">Esemény időpontja</label>
                    <input type="datetime-local" class="form-control" id="event-date" name="event-date">
                    <div class="error" id="event-date-error"></div>
                </div>
                <div class="mb-3">
                    <label for="event-description" class="form-label">Esemény leírása</label>
                    <textarea type="text" class="form-control" id="event-description" name="event-description"></textarea>
                    <div class="error" id="event-description-error"></div>
                </div>
                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Esemény képe</label>
                    <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                    <div class="error" id="thumbnail-error"></div>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is-public" name="is_public" checked>
                    <label class="form-check-label" for="is-public">Nyilvános esemény</label>
                </div>
                <div class="mb-3" id="user-select-container" style="display: none;">
                    <label for="user-select" class="form-label">Válassz felhasználókat</label>
                    <select class="form-select" id="user-select">
                        <option value="">Válassz felhasználót!</option>
                        @foreach($allUsers as $otherUser)
                            @if($otherUser->id !== $event->author_id)
                                <option value="{{$otherUser->id}}">{{$otherUser->name}} ({{$otherUser->email}})</option>
                            @endif
                        @endforeach
                    </select>
                    <div id="selected-users" class="mt-3"></div>
                </div>
                <input type="hidden" id="selected-users-input" name="selected_users">
                <button class="btn btn-outline-primary mb-5" onclick="toggleEdit()" type="reset">Mégsem</button>
                <button class="btn btn-primary mb-5">Változtatások mentése</button>
                
            </form>



            <div class="details">
                <div id="badge">
                    <x-badge :event="$event" />
                </div>
                
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
          
        </div>
        
        <div class="col-12 col-sm-6 right-side">
            Szervező: <br>
            <b><a href="/profile/{{$event->author_id}}"><p class="mb-5">{{$event->author->name}}</p></a></b>
            @if (Auth::check())
                @if (Auth::user()->id === $event->author_id)
                    <button class="btn btn-primary disabled mb-3">Ott leszek!</button>
                    <button class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#deleteEventModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                          </svg>
                        Törlés
                    </button>
                    <p class="error">Nem jelentkezhetsz a saját eseményedre!</p>
                @elseif (!$isInterested)
                    <button class="btn btn-primary mb-3" id="interestedButton">Ott leszek!</button>
                @else
                    <button class="btn btn-primary disabled mb-3">Jelentkeztél!</button>
                @endif
            @else
                <button class="btn btn-primary disabled mb-3">Ott leszek!</button>
                <p class="error">Jelentkezz be, hogy jelentkezni tudj az eseményre!</p>
            @endif
            <div class="alert alert-success" id="interested-alert-success">Jelentkeztél az eseményre!</div>
            <div class="alert alert-danger" id="interested-alert-fail">Hiba a jelentkezés során!</div>
        </div>
        <div id="form-message" class="mt-3"></div>
        <h2 class="mb-3 mt-5">Leírás:</h2>
        <p>{{$event->description}}</p>
    </div>

    <!-- Törlés megerősítés -->
    <div class="modal fade" id="deleteEventModal" tabindex="-1" aria-labelledby="deleteEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEventModalLabel">Esemény törlése</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Bezárás"></button>
                </div>
                <div class="modal-body">
                    Biztosan törölni szeretnéd az eseményt? Ez a művelet nem vonható vissza!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Törlés</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    


    <script>
        let selectedUsersArray = [];
        $(document).ready(function() {
            $('#interested-alert-success').hide();
            $('#interested-alert-fail').hide();
            $('#interestedButton').click(function() {
                $.ajax({
                    url: '{{ url('/event/interested') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        event_id: '{{ $event->id }}'
                    },
                    success: function(response) {
                        $('#interested-alert-success').fadeIn().delay(1000).fadeOut();
                        $('#interestedButton').text('Jelentkeztél!').prop('disabled', true);
                        let currentCount = parseInt($('#interestedCount').text());
                        $('#interestedCount').text(currentCount + 1);
                    },
                    error: function(xhr) {
                        alert('Hiba! :(');
                    }
                });
            });

            $('#is-public').change(function() {
                if ($(this).is(':checked')) {
                    $('#user-select-container').hide();
                } else {
                    $('#user-select-container').show();
                }
            });

            $('#user-select').change(function() {
                let selectedUserId = $(this).val();
                let selectedUserText = $('#user-select option:selected').text();
                if (selectedUserId && !selectedUsersArray.includes(selectedUserId)) {
                    $('#selected-users').append(`<div class="selected-user-bubble" data-user-id="` + selectedUserId + `"><b>`
                         + selectedUserText + 
                         `</b> <button class="clear-user" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                            </svg>
                            </button>
                        </div>`);
                    selectedUsersArray.push(selectedUserId);
                    console.log(selectedUsersArray);
                }
            });

            $('#selected-users').on('click', '.clear-user', function() {
                const userId = $(this).closest('.selected-user-bubble').data('user-id');
                const index = selectedUsersArray.indexOf(String(userId));
                if (index > -1) {
                    selectedUsersArray.splice(index, 1);
                }
                console.log(selectedUsersArray);
                $(this).closest('.selected-user-bubble').remove();
                
            });

            $('#update-event-form').on('submit', function(event) {
                event.preventDefault();
                $('#selected-users-input').val(JSON.stringify(selectedUsersArray)) ?? ''; 
                setTimeout(() => {
                    $('#form-message').fadeOut();
                }, 2000);
                let formData = new FormData(this);
                const baseUrl = "{{asset('')}}"

                $.ajax({
                    url: `/events/{{$event->id}}/update`,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#form-message').html('<div class="alert alert-success">Esemény sikeresen frissítve!</div>').show();
                        $('#event-name').val(response.event.name);
                        $('#event-type').val(response.event.type);
                        $('#event-location').val(response.event.location);
                        $('#event-date').val(response.event.date);
                        $('#event-description').val(response.event.description);
                        $('#badge').html(response.badge);
                        if (response.event.thumbnail) {
                            $('.image-container img').attr('src', `${baseUrl}${response.event.thumbnail}`);
                        }


                        $('.details').find('b').eq(0).text(response.event.location);
                        $('.details').find('b').eq(1).text(response.event.date.replace('T', ' '));
                        $('.details').find('b').eq(2).text(response.event.interested_count);

                        
                        $('#update-event-form').hide();
                        $('.details').show();
                        $('#edit-icon').css("color", "black");
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        if (errors) {
                            $('#event-name-error').text(errors['event-name'] ? errors['event-name'][0] : '').show();
                            $('#event-location-error').text(errors['event-location'] ? errors['event-location'][0] : '').show();
                            $('#event-type-error').text(errors['event-type'] ? errors['event-type'][0] : '').show();
                            $('#event-date-error').text(errors['event-date'] ? errors['event-date'][0] : '').show();
                            $('#event-description-error').text(errors['event-description'] ? errors['event-description'][0] : '').show();
                        }
                    }
                });
            });
        });

        $('#update-event-form').hide();

        $('#confirmDeleteButton').click(function() {
        $.ajax({
            url: `/events/{{$event->id}}/delete`,
            method: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#deleteEventModal').modal('hide');

                
                if (document.referrer) {
                    window.location.href = document.referrer;
                } else {
                    window.location.href = '/';
                }
            },
            error: function(xhr) {
                alert('Hiba történt az esemény törlése közben.');
            }
        });
    });

        let clickCounter = 1;
        function toggleEdit() {
            if (clickCounter % 2 === 1) {
                $('#update-event-form').show();
                $('#event-name').val('{{$event->name}}');
                $('#event-type').val('{{$event->type}}');
                $('#event-location').val('{{$event->location}}');
                $('#event-date').val('{{$event->date}}');
                $('#event-description').val('{{$event->description}}');
                $('#edit-icon').css("color", "blue");
                $('.details').hide();
            } else {
                $('#update-event-form').hide();
                $('.details').show();
                $('#edit-icon').css("color", "black");
            }
            clickCounter++;
        }
    </script>
</body>
</html>
