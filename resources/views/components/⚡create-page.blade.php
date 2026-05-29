<?php

use Livewire\Component;
use App\Models\pages;

new class extends Component
{
    public $title = '';
    public $caption = '';
    public $slug = '';
    public $btnText = '';
    public $btnUrl = '';
    
    public $status;
    
    public function save(){

        if($this->btnText == '' || $this->btnUrl == ''){
            $this->btnText = 'null';
            $this->btnUrl = 'null';
        }

        pages::create([
            'title'=>$this->title,
            'caption'=>$this->caption,
            'slug'=>$this->slug,
            'btnText'=>$this->btnText,
            'btnUrl'=>$this->btnUrl,
        ]);

        $this->dispatch('pages-updated');
        $this->reset();

        $this->status = "Page Added Successfully ";
    }

    public function deleteStatus(){
        $this->status = '';
    }
};
?>

<div>
    @if($status)
    <div class="flex msg-box items-center text-center mx-auto sm:max-w-md mt-6 shadow-md overflow-hidden sm:rounded-lg">
        <div class="w-full items-center">
            {{$status}}
        </div>
        <x-danger-button wire:click="deleteStatus" onclick="closeMsg()">X</x-danger-button>
    </div>
    @endif
    <div wire:ignore class="min-h-screen flex-col sm:justify-center w-full h-full items-center pt-6 sm:pt-0 bg-gray-100 fixed input-box">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h1 class="w-full text-center border border-solid border-black rounded-xs">ADD New Page</h1>
        <form wire:submit.prevent="save">
            <!-- hero title -->
            <div>
                <x-input-label for="title" :value="__('title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" wire:model="title" :value="old('title')" required autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- caption title -->
            <div>
                <x-input-label for="caption" :value="__('caption')" />
                <x-text-input id="caption" class="block mt-1 w-full" type="text" wire:model="caption" :value="old('caption')" required autofocus autocomplete="caption" />
                <x-input-error :messages="$errors->get('caption')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="slug" :value="__('slug')" />
                <x-text-input id="slug" class="block mt-1 w-full" type="text" wire:model="slug" :value="old('slug')" required autofocus autocomplete="slug" />
                <x-input-error :messages="$errors->get('slug')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="btnText" :value="__('btnText')" />
                <x-text-input id="btnText" class="block mt-1 w-full" type="text" wire:model="btnText" :value="old('btnText')" autofocus autocomplete="btnText" />
                <x-input-error :messages="$errors->get('btnText')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="btnUrl" :value="__('btnUrl')" />
                <x-text-input id="btnUrl" class="block mt-1 w-full" type="text" wire:model="btnUrl" :value="old('btnUrl')" autofocus autocomplete="btnUrl" />
                <x-input-error :messages="$errors->get('btnUrl')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">     
                <div>
                <x-primary-button type="submit" onclick="cancel()" class="ms-3 mr-4">
                    save
                </x-primary-button>
                </div>
                <x-danger-button type="reset" onclick="cancel()">
                    cancel
                </x-danger-button>
                
            </div>
        </form>
    </div>
    </div>
</div>