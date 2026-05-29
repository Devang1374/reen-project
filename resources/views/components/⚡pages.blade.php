<?php

use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\pages;

new class extends Component
{
    public $search;
    public $pages;
    public $status;

    public $uid;
    public $title;
    public $caption;
    public $slug;
    public $btnText;
    public $btnUrl;

    #[on('pages-updated')]
    public function mount(){
        return $this->pages = pages::get();
    }

    public function updatedSearch(){
        $this->pages = pages::where('title','like',"%{$this->search}%")->orWhere('caption','like',"%{$this->search}%")->orWhere('slug','like',"%{$this->search}%")->get();
    }

    public function delete($id){    
        pages::where('id', $id)->delete();

        
        $this->dispatch('pages-updated');
        $this->status = "Page Deleted successfully";
    
    }

    public function update(){
        if($this->btnText == '' || $this->btnUrl == ''){
            $this->btnText = 'null';
            $this->btnUrl = 'null';
        }

        pages::where('id', $this->uid)->update([
            'title'=>$this->title,
            'caption'=>$this->caption,
            'slug'=>$this->slug,
            'btnText'=>$this->btnText,
            'btnUrl'=>$this->btnUrl,
        ]);

        $this->status = "Page Updated successfully";

        $this->dispatch('pages-updated');
        $this->reset(['uid', 'title', 'caption', 'slug', 'btnText', 'btnUrl']);
    }

    public function deleteStatus(){
        $this->status = '';
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

    <livewire:create-page/>

    <div class="flex justify-between max-w-7xl max-h-90 mx-auto bg-white shadow-md my-10 sm:rounded-lg">
        <x-text-input type="text" wire:model.live="search" placeholder="search..."/>
        <x-primary-button onclick="showInput()">ADD</x-primary-button>
    </div>

    <div class="max-w-7xl max-h-90 mx-auto px-4 sm:px-6 lg:px-8 bg-white shadow-md my-10 sm:rounded-lg">
        <flux:table container:class="flex w-full max-h-90">
            <flux:table.columns sticky class="bg-white">
                <flux:table.column>ID</flux:table.column>
                <flux:table.column>Title</flux:table.column>
                <flux:table.column>caption</flux:table.column>
                <flux:table.column>slug</flux:table.column>
                <flux:table.column>Button-Text</flux:table.column>
                <flux:table.column>Button-Url</flux:table.column>
                <flux:table.column>Remove</flux:table.column>
                <flux:table.column>Update</flux:table.column>
            </flux:table.columns>

            @php
                $counter = 0;
            @endphp

            <flux:table.rows>
                @foreach ($pages as $page)
                <flux:table.row wire:key="page-item-{{$page['id']}}">
                    <flux:table.cell>{{++$counter}}</flux:table.cell>
                    <flux:table.cell>{{$page['title']}}</flux:table.cell>
                    <flux:table.cell>{{$page['caption']}}</flux:table.cell>
                    <flux:table.cell>{{$page['slug']}}</flux:table.cell>
                    <flux:table.cell>{{$page['btnText']}}</flux:table.cell>
                    <flux:table.cell>{{$page['btnUrl']}}</flux:table.cell>
                    <flux:table.cell>  
                    <x-primary-button wire:click="delete({{$page['id']}})">X</x-primary-button>
                    </flux:table.cell>
                    <flux:table.cell>
                        <x-primary-button onclick="showPageUpdateForm(`{{$page['id']}}`, `{{$page['title']}}`, `{{$page['caption']}}`, `{{$page['slug']}}`, `{{$page['btnText']}}`,`{{$page['btnUrl']}}`)">🖊</x-primary-button>
                    </flux:table.cell>
                </flux:table.row>
                @endforeach

            </flux:table.rows>
        </flux:table>
    </div>

    <div wire:ignore class="update-form min-h-screen flex-col sm:justify-center w-full h-full items-center pt-6 sm:pt-0 bg-gray-100 fixed input-box">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h1 class="w-full text-center border border-solid border-black rounded-xs">Update Page</h1>
        <form wire:submit.prevent="update">
            <x-text-input id="uid" class="block mt-1 w-full" type="hidden" wire:model="uid" :value="old('uid')" required autofocus autocomplete="uid" />
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
                <x-primary-button type="submit" onclick="cancelUpdate()" class="ms-3 mr-4">
                    save
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