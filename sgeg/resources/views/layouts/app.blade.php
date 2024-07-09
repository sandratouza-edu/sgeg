<!DOCTYPE html>
<html lang="es{{-- str_replace('_', '-', app()->getLocale()) --}}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SGEG </title>
        <!-- style provisional -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css" />
        <link href ="{{ asset('assets/css/style.css') }}" >
        <style>
            body {
                padding: 15px 50px;
                font-size: 80%;
                --pico-form-element-spacing-vertical: 0.55rem;
            }
            .pagination svg.w-5.h-5 {
                width:50px;
            }
            input[type=submit] {
                max-width: 160px;
               
            }
            input[type=text] {
                max-width: 360px;
            }
            .link-button {
                display: inline-block;
                padding: 10px 20px;
                border: var(--pico-border-width) solid var(--pico-border-color);
                border-radius: var(--pico-border-radius);
                outline: 0;
                background-color: var(--pico-background-color);
                box-shadow: var(--pico-box-shadow);
                color: var(--pico-color);
                font-weight: var(--pico-font-weight);
                font-size: 1rem;
                line-height: var(--pico-line-height);
                text-align: center;
                text-decoration: none;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
                transition: background-color var(--pico-transition), border-color var(--pico-transition), color var(--pico-transition), box-shadow var(--pico-transition);
            }
            .form-button {
                display: inline-block;
                padding: 10px 20px;
                font-size: 1rem;
            }
            input.form-button {
                font-size: 0.8em;
                padding: 10px;
            }
            a.link-button {
                border: 1px solid;
                font-size: 80%;
            }
        </style>
    </head>
    <body class="antialiased">
        <header>
           @include('layouts._partials.menu')
         {{--  @component('components.nav-login') 
    <h2>SGEG</h2>      
           @endcomponent --}}
         
           @yield('tools')
        </header>
        <main>
            
            @yield('content')

            @yield('scripts')
           
        </main>
    </body>
</html>
@stack('modals')
