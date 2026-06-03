@php
    $isActive = false;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mid Chack</title>
    <style>
        @import '../../vendor/livewire/flux/dist/flux.css';
        @custom-variant dark (&:where(.dark, .dark *));

        .red{
            border:1px solid red;
        }

        form{
            width: 300px;
            margin:0 auto;
            display:flex;
            flex-direction:column;
            gap:10px
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
     @fluxAppearance
</head>
<body>
    <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle" aria-label="Toggle dark mode" />
    <h1>{{$auth}}</h1>
    <form action="{{route('midchack')}}" @class(["bg-blue-400"=> $isActive]) method="post">
        @csrf

        <input type="hidden" name="token" value="my_secret_token">
        <flux:input type="text" name="name" placeholder="user_name" value="{{old('name')}}" clearable/>
        @error('name')
            <label for="">{{$message}}</label>
        @enderror
        <flux:input type="text" name="email" placeholder="user@email.." clearable value="{{old('email')}}"/>
        @error('email')
            <label for="">{{$message}}</label>
        @enderror
        <flux:button color="zinc" type="submit">submit</flux:button>
    </form>
    @livewireScripts
    @fluxScripts
</body>
</html>