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
<form action="{{route('verifyCode')}}" method="post">
    @csrf
        <input type="hidden" name="mobile" value="{{$mobile}}">
   کد:  <input type="text" name="code"><br>
    <button type="submit">تایید</button>
</form>
</body>
</html>
