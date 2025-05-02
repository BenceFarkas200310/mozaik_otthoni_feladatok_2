<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container col-10 col-sm-4 mt-5 p-3">
        <center><h1>Bejelentkezés</h1></center>
        <form action="">
            @csrf
            <div class="mb-3">
                <label for="emailInput" class="form-label">Email cím:</label>
                <input type="email" class="form-control" id="emailInput" placeholder="name@example.com">
            </div>

            <div class="mb-3">
                <label for="passwordInput" class="form-label">Jelszó:</label>
                <input type="password" class="form-control" id="passwordInput">
            </div>

            <div class="mb-4">
                <center><button type="submit" class="btn btn-primary">Bejelentkezés</button></center>
            </div>

            <div class="mb-3">
                Még nincs fiókod? <a href="/">Regisztrálj!</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>