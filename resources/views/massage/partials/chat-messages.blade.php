<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    @if ($messages->isEmpty())
        <p style="text-align: center; color: #777;">ไม่มีข้อความ</p>
    @else
        @foreach ($messages as $message)
            @if ($message->send_form == $sellerId)
                <p class="chat-message seller-message">{{ $message->message }}</p>
            @else
                <p class="chat-message buyer-message">{{ $message->message }}</p>
            @endif
        @endforeach
    @endif

</body>

</html>
