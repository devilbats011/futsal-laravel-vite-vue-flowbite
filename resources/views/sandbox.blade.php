<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sandbox</title>
</head>

<body>


    <div>sand box</div>
    <br><br>
    @if (Session::has('message'))
        <div class="">{{ Session::get('message') }}</div>
    @endif
</body>

</html>
