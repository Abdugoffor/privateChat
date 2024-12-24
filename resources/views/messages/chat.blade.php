<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite('resources/js/app.js')
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4">
                @foreach ($users as $user)
                    <li><a href="{{ route('messages.index', $user->id) }}">{{ $user->name }}</a></li>
                @endforeach
            </div>
            <div class="col-8">
                <h2>Chat</h2>
            </div>
        </div>
    </div>
    <script>
        const userId = @json(auth()->user()->id);
    </script>
</body>

</html>
