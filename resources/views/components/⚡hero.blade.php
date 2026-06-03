<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\heroBanner;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\Storage;


new class extends Component
{
    use WithFileUploads;
    public $uid = '';
    public $title = '';
    public $caption = '';
    public $btnText = '';
    public $btnUrl = '';
    public $path = '';
    public $status;
    
    public $imageFile = null;

    #[Reactive]
    public $heros;

    public function delete($id){
        $imagePath = heroBanner::where('id',$id)->get('file-path')->first();
        Storage::disk('public')->delete(trim($imagePath['file-path']));

        heroBanner::where('id', $id)->delete();

        
        $this->dispatch('banner-updated');
        $this->status = "Hero Banner Deleted successfully";
    }
    

    public function update(){
        $imagePath;
        if($this->imageFile){
            $imagePath = heroBanner::where('id',$this->uid)->get('file-path')->first();
            Storage::disk('public')->delete(trim($imagePath['file-path']));

            $this->path = $this->imageFile->store('images', 'public');
        }else{
            $hero = heroBanner::where('id', $this->uid)->first();
            $this->path = $hero['file-path'];
        }
        heroBanner::where('id', $this->uid)->update([
            'title'=>$this->title,
            'caption'=>$this->caption,
            'btn-text'=>$this->btnText,
            'btn-url'=>$this->btnUrl,
            'file-path'=>$this->path
        ]);

        $this->status = "hero Banner Updated successfully";

        $this->dispatch('banner-updated');
        $this->reset(['uid', 'title', 'caption', 'btnText', 'btnUrl', 'imageFile']);

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

<div class="max-w-7xl max-h-90 mx-auto px-4 sm:px-6 lg:px-8 bg-white shadow-md my-10 sm:rounded-lg">

                    <flux:table container:class="flex w-full max-h-90">
                        <flux:table.columns sticky class="bg-white">
                            <flux:table.column>ID</flux:table.column>
                            <flux:table.column>Title</flux:table.column>
                            <flux:table.column>Caption</flux:table.column>
                            <flux:table.column>Button-Text</flux:table.column>
                            <flux:table.column>Button-Url</flux:table.column>
                            <flux:table.column>File-Path</flux:table.column>
                            <flux:table.column>Remove</flux:table.column>
                            <flux:table.column>Update</flux:table.column>
                        </flux:table.columns>

                        @php
                            $counter = 0;
                        @endphp

                        <flux:table.rows>
                            @foreach ($heros as $hero)
                            <flux:table.row wire:key="hero-item-{{$hero['id']}}">
                                <flux:table.cell>{{++$counter}}</flux:table.cell>
                                <flux:table.cell>{{$hero['title']}}</flux:table.cell>
                                <flux:table.cell>{{$hero['caption']}}</flux:table.cell>
                                <flux:table.cell>{{$hero['btn-text']}}</flux:table.cell>
                                <flux:table.cell>{{$hero['btn-url']}}</flux:table.cell>
                                <flux:table.cell>{{$hero['file-path']}}</flux:table.cell>
                                <flux:table.cell>  
                                <x-primary-button wire:click="delete({{$hero['id']}})">X</x-primary-button>
                                </flux:table.cell>
                                <flux:table.cell>
                                    <x-primary-button onclick="showUpdateForm(`{{$hero['id']}}`, `{{$hero['title']}}`, `{{$hero['caption']}}`, `{{$hero['btn-text']}}`, `{{$hero['btn-url']}}`, `{{$hero['file-path']}}`)">🖊</x-primary-button>
                                </flux:table.cell>
                            </flux:table.row>
                            @endforeach

                        </flux:table.rows>
                    </flux:table>

                    <div wire:ignore class="update-form fixed w-full h-full min-h-screen flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 update-box">
                        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                            <form wire:submit.prevent="update">
                                @csrf
                <x-text-input id="uid" class="block mt-1 w-full" type="hidden" wire:model="uid" :value="old('uid')" required autofocus autocomplete="uid" />
                

            <!-- hero title -->
            <div>
                <x-input-label for="title" :value="__('title')" />
                <x-text-input id="update-title" class="block mt-1 w-full" type="text" wire:model="title" :value="old('title')" required autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- caption title -->
            <div>
                <x-input-label for="caption" :value="__('caption')" />
                <x-text-input id="update-caption" class="block mt-1 w-full" type="text" wire:model="caption" :value="old('caption')" required autofocus autocomplete="caption" />
                <x-input-error :messages="$errors->get('caption')" class="mt-2" />
            </div>

            <!-- hero button text -->
            <div>
                <x-input-label for="button-text" :value="__('button-text')" />
                <x-text-input id="update-button-text" class="block mt-1 w-full" type="text" wire:model="btnText" :value="old('button-text')" required autofocus autocomplete="button-text" />
                <x-input-error :messages="$errors->get('button-text')" class="mt-2" />
            </div>

            <!-- hero button url -->
            <div>
                <x-input-label for="button-url" :value="__('button-url')" />
                <x-text-input id="update-button-url" wire:model="btnUrl" class="block mt-1 w-full" type="text" name="btn-url" :value="old('button-url')" required autofocus autocomplete="button-url" />
                <x-input-error :messages="$errors->get('button-url')" class="mt-2" />
            </div>

            <div>
                <img src="" id="hero-image" class="max-w-10" alt="">
            </div>

            <div class="block mt-4">
                <label for="image-file" class="inline-flex items-center">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Image File:') }}</span>
                    <input id="image-file" wire:model="imageFile" wire:key="hero-update-file-input" type="file" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">     
                <div onclick="cancelUpdate()">
                <x-primary-button type="submit" class="ms-3 mr-4">
                    Update
                </x-primary-button>
                </div>
                <x-primary-button type="reset" onclick="cancelUpdate()">
                    cancel
                </x-primary-button>
                
            </div>
        </form>
        </div>
        </div>
    </div>
</div>