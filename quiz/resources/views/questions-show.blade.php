<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/style.css') }}" />


</head>
<body>
<div class="block1">
    Вопрос {{ $question->getUUID() }}:<br><br> <b>{{ $question->getText() }}</b><br>
    <div class="block3">
        <form action="{{ route('questions.next', ['uuid'=> $question->getUUID()]) }}" method="post">
            @csrf

            <div class="input-blocks">
                @foreach ($question->getChoices() as $choice)
                    <label><input type='{{ $type_input }}' @if($type_input == 'radio') name="answer"
                                  @else name="answer[]" @endif value='{{ $choice->getUUID() }}'
                                  @if (in_array($choice->getUUID(), session()->get('answers')[$question->getUUID()] ?? [])) checked='checked' @endif>
                        {{ $choice->getUUID()}} {{ $choice->getText() }}
                    </label><br>
                @endforeach
            </div>

            <div class="button-block">
                <a class='button' href="{{ route('questions.prev', ['uuid'=>$question->getUUID()]) }}">back</a>
                <input class='button' type="submit" value="next">
            </div>
        </form>
    </div>
</div>
</body>
</html>
