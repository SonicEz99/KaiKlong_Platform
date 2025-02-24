<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายการโปรด</title>
    @vite(['resources/js/app.js'])
</head>

@extends('layouts.page')
@section('content')
    <?php
    $user = Auth::user(); ?>

    <body>
        <div class="container">
            <h1>
                Hello รายการโปรด
            </h1>
        </div>
    </body>
@endsection

</html>
