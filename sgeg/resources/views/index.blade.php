<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SGEG </title>
        <!-- style provisional -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css" />
    </head>
    <body class="antialiased">
        <header>
           @component('components.nav-login')
            
           @endcomponent
        </header>
        <main>
            <h2>SGEG</h2>

            <a href="{{ route('sendmail') }}">Mail me</a>
        </main>
    </body>
</html>
