<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{route('index')}}" method="get">
    @csrf
    page: <input type="text" name="page">
    limit: <input type="text" name="limit">
    <button type="submit">submit</button>
</form>
</body>
</html>
