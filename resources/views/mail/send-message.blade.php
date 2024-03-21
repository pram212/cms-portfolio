<x-mail::message>
# From {{ $name }}

{{ $message }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
