<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mon site')</title>
    @vite('resources/css/app.css') <!-- si tu utilises Vite + Tailwind -->
</head>
<body class="bg-gray-100 text-gray-900">

    @include('partials.navbar')

    <main class="container mx-auto py-6">
        @yield('content')
    </main>

</body>
</html>
