<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Calzados Marvic')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/css/custom/home.css', 'resources/js/custom/home.js'])
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@6.5.95/css/materialdesignicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:wght@400;600;700;800;900&display=swap" rel="stylesheet">

</head>
<body class="bg-[#f4f4f4]">
    @include('Partials.Header.Logged.headerlogged')

    <div class="content p-4 sm:ml-64 pt-20">
        @yield('content')
    </div>



</body>
</html>
