<x-app-layout>
    
    <livewire:create-hero/>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Hero-Banner') }}
        </h2>
    </x-slot>

    <livewire:new-search/>
</x-app-layout>