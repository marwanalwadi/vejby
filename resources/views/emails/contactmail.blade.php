{{-- <!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>SurfSide</title>
    </head>

    <body>
        <h1>Contact from Message</h1>
        <p>Name: {{$name}}</p>
<p>Email: {{$email}}</p>
<p>Phone: {{$phone}}</p>
<p>Message: {{$msg}}</p>

</body>

</html> --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>

    <body class="antialiased">


        <div id="app">
            <h1>Contact from Message</h1>
            <p>Name: {{$name}}</p>
            <p>Email: {{$email}}</p>
            <p>Phone: {{$phone}}</p>
            <p>Message: {{$msg}}</p>
            <send-mail :name="name" :email="email" :phone="phone" :msg="msg"></send-mail>
        </div>
        </div>
    </body>




    <script src="{{mix('js/app.js')}}"></script>

</html>
