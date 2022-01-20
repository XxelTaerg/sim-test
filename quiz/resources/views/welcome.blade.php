<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />
    </head>
    <body >
        <div class="block1"><h1>Добро пожаловать на тестирование!</h1>
            <p>Хотите проверить свои знания? Вам необходимо пройти тест на отлично, удачи!</p>
            <div class="button-block"><p><a class='button' href="{{ route('start') }}">let's begin</a></p></div>
        </div>
    </body>
</html>
