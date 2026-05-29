<?php

use Livewire\Component;
use App\Models\features;

new class extends Component
{
    public $title = '';
    public $caption = '';
    public $icon = '';
    public $status = '';

    public function saveFeature(){
        if($this->title == '' || $this->caption=='' || $this->icon==''){
            return session()->flash('status','All fields are required');
        }else{

            features::create([
                'title' => $this->title,
                'caption' => $this->caption,
                'icon' => $this->icon
            ]);

            $this->dispatch('feature-updated');
            $this->title = '';
            $this->caption = '';
            $this->icon = '';
            $this->status = "Feature Save Successfully";
        }
    }

};
?>

<div>
    @session('status')
    <div class="flex bg-red-500 msg-box fixed right-3 bottom-7 z-111 items-center text-center mx-auto sm:max-w-md mt-6 shadow-md overflow-hidden sm:rounded-lg">
        <div class="w-full items-center p-3">
            {{$value}}
        </div>
        <x-danger-button onclick="closeMsg()">X</x-danger-button>
    </div>
    @endsession
    
    @if($status)
    <div class="flex msg-box fixed right-3 bottom-3 z-111 items-center text-center mx-auto sm:max-w-md mt-6 shadow-md overflow-hidden sm:rounded-lg">
        <div class="w-full items-center p-3">
            {{$status}}
        </div>
        <x-danger-button onclick="closeMsg()">X</x-danger-button>
    </div>
    @endif
    <div class="min-h-screen flex-col sm:justify-center w-full h-full items-center pt-6 sm:pt-0 bg-gray-100 fixed input-box">
        <form wire:submit.prevent="saveFeature" class="w-100 flex flex-col gap-3">
            <h1 class="w-full text-center border border-solid border-black rounded-xs">ADD New Features</h1>
            <div>
                <x-input-label for="title" :value="__('title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" wire:model="title" :value="old('title')" autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="caption" :value="__('caption')" />
                <x-text-input id="caption" class="block mt-1 w-full" type="text" wire:model="caption" :value="old('caption')" autofocus autocomplete="caption" />
                <x-input-error :messages="$errors->get('caption')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="icon" :value="__('icon')" />
                <x-text-input id="icon" class="block mt-1 w-full" type="text" wire:model="icon" :value="old('icon')"  autofocus autocomplete="icon" />
                <x-input-error :messages="$errors->get('icon')" class="mt-2" />
            </div>
            <div class="flex gap-3 w-full justify-end">
                <x-primary-button>SAVE</x-primary-button>
                <x-danger-button type="reset" onclick="cancel()">CANCEL</x-danger-button>
            </div>
        </form>
    </div>
</div>