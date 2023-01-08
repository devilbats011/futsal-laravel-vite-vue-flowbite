<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
</head>

<body>
    @if (Session::has('message'))
        <div class="">{{ Session::get('message') }}</div>
        <br><br>
    @endif

    {{-- * https://laravel.com/docs/4.2/validation#working-with-error-messages --}}
    @if ($errors->any())
        <h4>{{ $errors }}</h4>
    @endif

    {{-- * https://stackoverflow.com/questions/21963327/looping-through-validation-errors-in-view --}}
    @foreach ($errors->all() as $error)
        {{ $error }}<br />
    @endforeach

    <h1>PAYMENT METHOD:</h1>
    <form action="{{ route('book.payment.decision',$book) }}" method="POST" class="my-3">
        @csrf
        <select name="payment_method" id="payment_method">
            <option value="">Choose</option>
            <option value="counter">Counter</option>
            <option value="online">Online</option>
        </select>
        <input type="submit" value="Submit">
    </form>
    <br><br>
    {{ $book }}
</body>

</html>
