<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/js/app.js'])
</head>

<body>
    <p>You are logged in</p>

    <p>Hi, {{ session('user_name') }}</p>

    <p>Hi, {{ Auth::user()->name ?? 'Guest' }}</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button id="logout-button" type="submit" class="btn btn-danger">Log out</button>
    </form>
</body>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    document.getElementById('logout-button').addEventListener('click', function () {
        axios.post("{{ route('logout') }}", {}, {
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        })
        .then(response => {
            alert(response.data.message); // Show logout success message
            window.location.href = response.data.redirect;  // Redirect to home page
        })
        .catch(error => {
            console.error('Logout failed:', error);
        });
    });
</script>

</html>