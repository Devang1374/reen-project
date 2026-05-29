<?php

use Livewire\Component;
use App\Models\portfolio;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;

new class extends Component
{
    use WithFileUploads;
    
    #[Validate('required', message: 'Please provide a Title')] 
    public $title = '';
    public $category = '';
    public $path = '';
    public $isActive;
    public $status;
    
    public $imageFile;

    public function save(){
        $validated = $this->validate();

        if(!$this->imageFile){
            $this->status = "Please provide a image file";
            return;
        }

        $this->path = $this->imageFile->store('images', 'public');

        $active;
        if($this->isActive == "true"){
            $active = true;
        }else{
            $active = false;
        }
        portfolio::create([
            'title'=>$this->title,
            'category'=>$this->category,
            'isActive'=>$active,
            'file-path'=>$this->path
        ]);

        $this->dispatch('portfolio-updated');
        $this->reset();

        $this->status = "Portfolio Added Successfully ";
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
        <h1 class="w-full text-center border border-solid border-black rounded-xs">ADD New Features</h1>
        <form wire:submit.prevent="save">
            <!-- hero title -->
            <div>
                <x-input-label for="title" :value="__('title')" />
                <x-text-input id="title" class="block mt-1 w-full" type="text" wire:model="title" :value="old('title')" required autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- category title -->
            <div>
                <x-input-label for="category" :value="__('category')" />
                <x-text-input id="category" class="block mt-1 w-full" type="text" wire:model="category" :value="old('category')" required autofocus autocomplete="category" />
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>

            <div class="flex flex-row mt-2 gap-2">
                <x-input-label for="isActive" :value="__('Active:')" />
                <input type="radio" value="true" wire:model="isActive"/>
                <x-input-label for="isActive" :value="__('Not Active:')" />
                <input type="radio" value="false" wire:model="isActive"/>
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