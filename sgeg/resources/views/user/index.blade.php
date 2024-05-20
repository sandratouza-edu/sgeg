<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 uvigo">
        

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            @include('layouts._partials.menu')
            <!-- Page Content -->
            <main>
 
                <h2>Participants list</h2>
                @if($users->isEmpty())
                    <p>Participants list is empty</p>
                @else
                <ul>
                    @foreach($users as $user)            
                        <li> {{ $user-> name }}</li>
                    @endforeach
                </ul>
                @endif
                <!-- Opción alternativa -->
                <ul>
                    @forelse($users as $user)            
                        <li> {{ $user-> name }} - Edad: {{ $user->age }}</li>
                    @empty
                    <li> List empty</li>
                    @endforelse
                </ul>              



            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
 