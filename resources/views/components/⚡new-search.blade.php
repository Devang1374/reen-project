<?php

use Livewire\Component;
use App\Models\heroBanner;
use Livewire\Attributes\On;


new class extends Component
{
    public $search = '';

    #[On('banner-updated')]
    public function search(){
        $heros = heroBanner::where('title', 'like', "%{$this->search}%")->get();
        return $heros;
    }

};
?>

<div>
    <div class="flex justify-between bg-white shadow-md mt-10 items-center h-10 max-w-7xl mx-auto sm:rounded-lg">
        <x-text-input type="text" wire:model.live="search" placeholder="Search Banner..." />
        <x-primary-button onclick="showInput()">Add</x-primary-button>
    </div>
    
    <livewire:hero :heros="$this->search()" wire:key="hero-search-{{$this->search}}"/> 
</div>