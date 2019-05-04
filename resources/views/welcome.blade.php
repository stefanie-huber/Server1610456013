<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KWM</title>


</head>
<body>
<ul>
    @foreach ($books as $book)
        <li>{{$book->title}} | {{$book->isbn}}</li>
    @endforeach
</ul>
</body>
</html>
