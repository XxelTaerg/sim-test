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
        <div class="block1">
            <h2>Поздравляем!</h2>
            <h2>Ваш итоговый результат:</h2>
            <p><h1>{{ $result * 100 }} %</h1></p>
            <p>Спасибо за участие в тестировании.</p>
            <p><a class="button" href="{{ URL('/') }}">Пройти заново</a></p>
        </div>
    </body>
</html>
