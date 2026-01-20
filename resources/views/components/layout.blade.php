<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite('resources/css/app.css')
        <title>{{ $title ?? "Class BOOM" }}</title>
    </head>
    <body>
        @auth
            <x-nav />
        @endauth

        {{ $slot }}
    </body>
<script>
    const themeToggle = document.getElementById('theme-toggle');
    const htmlEl = document.documentElement;

    if (localStorage.getItem('theme') === 'dark') htmlEl.classList.add('dark');

    themeToggle.addEventListener('click', () => {
        htmlEl.classList.toggle('dark');
        localStorage.setItem('theme', htmlEl.classList.contains('dark') ? 'dark' : 'light');
    });
</script>
</html>