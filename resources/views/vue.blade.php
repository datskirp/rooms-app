<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <title>{{ config('app.name') }}</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

    </head>
    <body id="app">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}', user: @json($user) }</script>
        @vite('resources/js/app.js')
    </body>
</html>
