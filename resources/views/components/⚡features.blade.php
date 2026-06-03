<?php

use Livewire\Component;
use App\Models\features;
use Livewire\Attributes\On; 

new class extends Component
{
    public $features;

    public $title = '';
    public $caption = '';
    public $icon = '';
    public $status = '';
    public $showCreateForm = false;
    public $uid = '';
    public $search = '';

    #[on('feature-updated')]
    public function mount(){
        return $this->features = features::get();
    }
        
    public function updatedSearch(){
        $this->features = features::where('title','like',"%{$this->search}%")->get();
    }

    public function delete($id){
        features::where('id', $id)->delete();

        $this->dispatch('feature-updated');
        $this->status = "Feature Deleted Successfully";
    }

    public function update(){
       if($this->title == '' || $this->caption=='' || $this->icon==''){
            session()->flash('status','All fields are required');
        }else{
            features::where('id', $this->uid)->update([
                'title' => $this->title,
                'caption' => $this->caption,
                'icon' => $this->icon
            ]);
            
            $this->dispatch('feature-updated');
            $this->status = "Feature updated Successfully";
        }
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
    
    <livewire:create-feature/>

    <div class="flex justify-between max-w-7xl max-h-90 mx-auto bg-white shadow-md my-10 sm:rounded-lg">
        <x-text-input type="text" wire:model.live="search" placeholder="search..."/>
        <x-primary-button onclick="showInput()">ADD</x-primary-button>
    </div>
    <div class="max-w-7xl max-h-90 mx-auto px-4 sm:px-6 lg:px-8 bg-white shadow-md my-10 sm:rounded-lg">
        <flux:table container:class="flex w-full max-h-90">
            <flux:table.columns sticky class="bg-white">
                <flux:table.column>ID</flux:table.column>
                <flux:table.column>Title</flux:table.column>
                <flux:table.column>Caption</flux:table.column>
                <flux:table.column>Icon</flux:table.column>
                <flux:table.column>Remove</flux:table.column>
                <flux:table.column>Update</flux:table.column>
            </flux:table.columns>

            @php
                $counter = 0;
            @endphp

            <flux:table.rows>
                @foreach ($features as $feature)
                <flux:table.row wire:key="feature-item-{{$feature['id']}}">
                    <flux:table.cell>{{++$counter}}</flux:table.cell>
                    <flux:table.cell>{{$feature['title']}}</flux:table.cell>
                    <flux:table.cell>{{$feature['caption']}}</flux:table.cell>
                    <flux:table.cell>{{$feature['icon']}}</flux:table.cell>
                    <flux:table.cell>  
                    <x-primary-button wire:click="delete({{$feature['id']}})">X</x-primary-button>
                    </flux:table.cell>
                    <flux:table.cell>
                        <x-primary-button onclick="showFeatureUpdateForm(`{{$feature['id']}}`, `{{$feature['title']}}`, `{{$feature['caption']}}`, `{{$feature['icon']}}`)">🖊</x-primary-button>
                    </flux:table.cell>
                </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </div>

    <div wire:ignore class="update-form fixed w-full h-full min-h-screen flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 update-box">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form wire:submit.prevent="update">
                @csrf
                <h1 class="w-full text-center border border-solid border-black rounded-xs">Update Features</h1>
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
                    <x-input-label for="icon" :value="__('icon')" />
                    <x-text-input id="update-button-text" class="block mt-1 w-full" type="text" wire:model="icon" :value="old('icon')" required autofocus autocomplete="icon" />
                    <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                </div>

                <!-- hero button url -->
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