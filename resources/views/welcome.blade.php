<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LIvewire</title>

	    @livewireStyles

    </head>
    <body class="antialiased">
        <livewire:hello-world/>

    @livewireScripts
    </body>
</html>
