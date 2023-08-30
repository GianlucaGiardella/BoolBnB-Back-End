<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ url('/logos/multicolor-logo.ico') }}" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BoolBnB</title>
    @vite('resources/js/app.js')
</head>

<body>
    @include('guests.includes.header')

    <div class="container" style="margin-top: 100px;">
        @yield('contents')
    </div>

    {{-- @include('guests.includes.footer') --}}
</body>

</html>
