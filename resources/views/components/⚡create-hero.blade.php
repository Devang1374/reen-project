<?php

use Livewire\Component;
use App\Models\heroBanner;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;

new class extends Component
{
    use WithFileUploads;
    
    #[Validate('required', message: 'Please provide a Title')] 
    public $title = '';
    public $caption = '';
    public $btnText = '';
    public $btnUrl = '';
    public $path = '';
    public $status;
    
    public $imageFile;

    public function save(){
        $validated = $this->validate();

        if(!$this->imageFile){
            $this->status = "Please provide a image file";
            return;
        }

        $this->path = $this->imageFile->store('images', 'public');

        heroBanner::create([
            'title'=>$this->title,
            'caption'=>$this->caption,
            'btn-text'=>$this->btnText,
            'btn-url'=>$this->btnUrl,
            'file-path'=>$this->path
        ]);

        $this->dispatch('banner-updated');
        $this->reset();

        $this->status = "Hero Banner Added Successfully ";
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
        
        <form wire:submit.prevent="save">
            @csrf

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

            <!-- hero button text -->
            <div>
                <x-input-label for="button-text" :value="__('button-text')" />
                <x-text-input id="button-text" class="block mt-1 w-full" type="text" wire:model="btnText" :value="old('button-text')" required autofocus autocomplete="button-text" />
                <x-input-error :messages="$errors->get('button-text')" class="mt-2" />
            </div>

            <!-- hero button url -->
            <div>
                <x-input-label for="button-url" :value="__('button-url')" />
                <x-text-input id="button-url" wire:model="btnUrl" class="block mt-1 w-full" type="text" name="btn-url" :value="old('button-url')" required autofocus autocomplete="button-url" />
                <x-input-error :messages="$errors->get('button-url')" class="mt-2" />
            </div>


            <div class="block mt-4">
                <label for="image-file" class="inline-flex items-center">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Image File:') }}</span>
                    <input id="image-file" wire:model="imageFile" wire:key="hero-update-file-input" type="file" class="rounded border-gray-300 required text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <x-input-error :messages="$errors->get('image-file')" class="mt-2" />
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">     
                <div>
                <button type="submit" onclick="cancel()" class="ms-3 mr-4">
                    save
                </button>
                </div>
                <x-primary-button type="reset" onclick="cancel()">
                    cancel
                </x-primary-button>
                
            </div>
        </form>
    </div>
    </div>
</div>