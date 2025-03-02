<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kaiklong | รายการโปรด</title>
    @vite(['resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            font-family: 'Noto Sans Thai', 'Prompt', sans-serif;
        }
        /* Add your custom styles here */
    </style>
</head>

@extends('layouts.page')
@section('content')

<body style="font-family: 'Noto Sans Thai', 'Prompt', sans-serif;">
    <div class="container text-center mt-5">
        <h1>📌 รายการโปรด</h1>
        <p>หน้านี้อยู่ระหว่างการพัฒนา...</p>
        <a href="{{ url('/home') }}" class="btn btn-primary">🔙 กลับหน้าหลัก</a>
    </div>

    <!-- Add your footer here -->
</body>
@endsection

</html>
