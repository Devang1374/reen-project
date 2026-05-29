<x-mail::message>

#Name:<x-mail::panel>{{$validated['name']}}</x-mail::panel>
#Email:<x-mail::panel>{{$validated['email']}}</x-mail::panel>
#Message:<x-mail::panel>{{$validated['message']}}</x-mail::panel>

<x-mail::button :url="'http://127.0.0.1:8000/'" color="success">
    Reen
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
