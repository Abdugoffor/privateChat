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
        <h2>{{ auth()->user()->name }}</h2>
        <div class="row mt-4">
            <div class="col-4">
                @foreach ($users as $user)
                    <li><a href="{{ route('messages.index', $user->id) }}">{{ $user->name }}</a></li>
                @endforeach
            </div>
            <div class="col-8">
                <form action="{{ route('messages.store', $chatId) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-8 offset-1 mt-2">
                            <input type="text" name="text" class="form-control" placeholder="Text">

                        </div>
                        <div class="col-2">
                            <input type="submit" name="ok" class="btn btn-primary" value="Send">
                        </div>
                    </div>
                </form>
                <h4>{{ $usersName->name }} :</h4>
                <div id="messageList">
                    @foreach ($models as $model)
                        @if ($model->img)
                            <img src="{{ asset($model->img) }}" width="100px" alt="">
                        @endif
                        <li><span class="text-danger">{{ $model->sender->name }}</span>,{{ $model->text }}</li>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
    <script>
        const chatId = @json($chatId->id);
    </script>
</body>

</html>
