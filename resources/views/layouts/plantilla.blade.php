<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie-edge">
    <title>@yield('titulo')</title>
    @vite('resources/sass/app.scss', 'resources/js/app.js')
    @vite('resources/css/navbar.css')
</head>

<body class="bg-colorPrincipal">
    @include('layouts.partials.header')

    <div class="row g-0">
        <div class="col-2">
            @include('layouts.partials.nav')
        </div>
        <div class="col-10 p-5 ">
            @yield('contenido')
        </div>
    </div>
    @include('layouts.partials.footer')

</body>

</html>
