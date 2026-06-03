<?php

use Livewire\Component;
use App\Models\portfolio;
use Livewire\Attributes\On; 
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

new class extends Component
{
    use WithFileUploads;
    public $uid = '';
    public $title = '';
    public $category = '';
    public $portfolios;
    public $isActive;
    public $search = '';
    public $status = '';

    public $imageFile = null;

    #[on('portfolio-updated')]
    public function mount(){
        return $this->portfolios = portfolio::get();
    }

    public function updatedSearch(){
        $this->portfolios = portfolio::where('title','like',"%{$this->search}%")->orWhere('category','like',"%{$this->search}%")->orWhere('isActive','like',"%{$this->search}%")->get();
    }

    public function delete($id){    
        $imagePath = portfolio::where('id',$id)->get('file-path')->first();
        Storage::disk('public')->delete(trim($imagePath['file-path']));

        portfolio::where('id', $id)->delete();

        
        $this->dispatch('banner-updated');
        $this->status = "portfolio Deleted successfully";
    
    }

    public function deleteStatus(){
        $this->status = '';
    }

    public function update(){
        $imagePath;
        if($this->imageFile){
            $imagePath = portfolio::where('id',$this->uid)->get('file-path')->first();
            Storage::disk('public')->delete(trim($imagePath['file-path']));

            $this->path = $this->imageFile->store('images', 'public');
        }else{
            $hero = portfolio::where('id', $this->uid)->first();
            $this->path = $hero['file-path'];
        }

        $active;
        if($this->isActive == "true"){
            $active = true;
        }else{
            $active = false;
        }

        portfolio::where('id', $this->uid)->update([
            'title'=>$this->title,
            'category'=>$this->category,
            'isActive'=>$active,
            'file-path'=>$this->path
        ]);

        $this->status = "hero Banner Updated successfully";

        $this->dispatch('portfolio-updated');
        $this->reset(['uid', 'title', 'category', 'imageFile']);

    }
};
?>

<div>
    @session('status')
        <div class="flex bg-red-500 msg-box fixed right-8 bottom-9 z-111 items-center text-center mx-auto sm:max-w-md mt-6 shadow-md overflow-hidden sm:rounded-lg">
            <div class="w-full items-center p-3">
                {{$value}}
            </div>
            <x-danger-button wire:click="deleteStatus" onclick="closeMsg()">X</x-danger-button>
        </div>
    @endsession

    @if($status)
        <div class="flex msg-box fixed right-3 bottom-16 z-111 items-center text-center mx-auto sm:max-w-md mt-6 shadow-md overflow-hidden sm:rounded-lg">
            <div class="w-full items-center p-3">
                {{$status}}
            </div>
            <x-danger-button wire:click="deleteStatus" onclick="closeMsg()">X</x-danger-button>
        </div>
    @endif

    <livewire:create-portfolio/>

    <div class="flex justify-between max-w-7xl max-h-90 mx-auto bg-white shadow-md my-10 sm:rounded-lg">
        <x-text-input type="text" wire:model.live="search" placeholder="search..."/>
        <x-primary-button onclick="showInput()">ADD</x-primary-button>
    </div>

    <div class="max-w-7xl max-h-90 mx-auto px-4 sm:px-6 lg:px-8 bg-white shadow-md my-10 sm:rounded-lg">

                    <flux:table container:class="flex w-full max-h-90">
                        <flux:table.columns sticky class="bg-white">
                            <flux:table.column>ID</flux:table.column>
                            <flux:table.column>Title</flux:table.column>
                            <flux:table.column>category</flux:table.column>
                            <flux:table.column>Active</flux:table.column>
                            <flux:table.column>File-Path</flux:table.column>
                            <flux:table.column>Remove</flux:table.column>
                            <flux:table.column>Update</flux:table.column>
                        </flux:table.columns>

                        @php
                            $counter = 0;
                        @endphp

                        <flux:table.rows>
                            @foreach ($portfolios as $portfolio)
                            <flux:table.row wire:key="portfolio-item-{{$portfolio['id']}}">
                                <flux:table.cell>{{++$counter}}</flux:table.cell>
                                <flux:table.cell>{{$portfolio['title']}}</flux:table.cell>
                                <flux:table.cell>{{$portfolio['category']}}</flux:table.cell>
                                <flux:table.cell>{{$portfolio['isActive']}}</flux:table.cell>
                                <flux:table.cell>{{$portfolio['file-path']}}</flux:table.cell>
                                <flux:table.cell>  
                                <x-primary-button wire:click="delete({{$portfolio['id']}})">X</x-primary-button>
                                </flux:table.cell>
                                <flux:table.cell>
                                    <x-primary-button onclick="showPortfolioUpdateForm(`{{$portfolio['id']}}`, `{{$portfolio['title']}}`, `{{$portfolio['category']}}`, `{{$portfolio['isActive']}}`, `{{$portfolio['file-path']}}`)">🖊</x-primary-button>
                                </flux:table.cell>
                            </flux:table.row>
                            @endforeach

                        </flux:table.rows>
                    </flux:table>

        <div wire:ignore class="update-form fixed w-full h-full min-h-screen flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 update-box">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <h1 class="w-full text-center border border-solid border-black rounded-xs">Update Features</h1>
                <form wire:submit.prevent="update">
                                @csrf
                <x-text-input id="uid" class="block mt-1 w-full" type="hidden" wire:model="uid" :value="old('uid')" required autofocus autocomplete="uid" />
                

            <!-- portfolio title -->
            <div>
                <x-input-label for="title" :value="__('title')" />
                <x-text-input id="update-title" class="block mt-1 w-full" type="text" wire:model="title" :value="old('title')" required autofocus autocomplete="title" />
                <x-input-error :messages="$errors->get('title')" class="mt-2" />
            </div>

            <!-- category title -->
            <div>
                <x-input-label for="category" :value="__('category')" />
                <x-text-input id="update-category" class="block mt-1 w-full" type="text" wire:model="category" :value="old('category')" required autofocus autocomplete="category" />
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>

            <div class="flex flex-row mt-2 gap-2">
                <x-input-label for="isActive" :value="__('Active')" />
                <input type="radio" id="status-active" name="isActive" value="true" wire:model="isActive">
                <x-input-label for="notActive" :value="__('Not Active')" />
                <input type="radio" id="status-notactive" name="isActive" value="false" wire:model="isActive">
            </div>

            <div>
                <img src="" id="portfolio-image" class="max-w-10" alt="">
            </div>

            <div class="block mt-4">
                <label for="image-file" class="inline-flex items-center">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Image File:') }}</span>
                    <input id="image-file" wire:model="imageFile" wire:key="portfolio-update-file-input" type="file" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">     
                <div onclick="cancelUpdate()">
                <x-primary-button type="submit" class="ms-3 mr-4">
                    Update
                </x-primary-button>
                </div>
                <x-danger-button type="reset" onclick="cancelUpdate()">
                    cancel
                </x-danger-button>
                
            </div>
        </form>
        </div>
        </div>
    </div>
</div>
</div>