<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BookStore</title>
</head>
<body>
<ul>
    @foreach ($books as $book)
        <li><a href="books/{{$book->id}}">{{$book->title}}</a></li>
    @endforeach
</ul>
</body>
</html>