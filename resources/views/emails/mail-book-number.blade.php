<x-mail::message>

<img src="https://img.freepik.com/free-vector/premier-soccer-football-tournament-background_1017-24106.jpg?w=2000&t=st=1673192484~exp=1673193084~hmac=0dda9514940232f8fad00ff3526200a01f5b7ea8205bf1171269d0f9e988559c" alt="https://img.freepik.com/free-vector/premier-soccer-football-tournament-background_1017-24106.jpg?w=2000&t=st=1673192484~exp=1673193084~hmac=0dda9514940232f8fad00ff3526200a01f5b7ea8205bf1171269d0f9e988559c" url=".." >

<div style="padding-top: 1.8rem;padding-bottom: 0" >
@if ($code)
YOUR BOOK NUMBER : {{$code}}
@else
YOUR BOOK NUMBER : -- Something Went Wrong..1
@endif
</div>

<x-mail::button :url="'http://localhost:8000/'">
Track Your Book Number
</x-mail::button>
<p style="white-space: pre;">
Thanks,
From Futsal Malaya Team ⚽
</p>
</x-mail::message>
