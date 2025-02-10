<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'My Laravel App')</title>
    
    @vite(['resources/js/app.js']) 
</head>
<body>
    @extends('layouts.app')
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
