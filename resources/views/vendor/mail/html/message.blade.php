<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">
{{-- {{ config('app.name') }} --}}
    Futsal Malaya
</x-mail::header>
</x-slot:header>
<main class="m-mid text-center">
{{-- Body --}}
{{ $slot }}
</main>

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{{ $subcopy }}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} {{ config('app.name') }}. Futsal Malaya Team ⚽
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
