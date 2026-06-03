<?php

use Livewire\Component;
use App\Models\contact;
use Livewire\Attributes\On; 

new class extends Component
{
    public $contacts;
    public $search;
    public $status;

    #[on('contact-updated')]
    public function mount(){
        $this->contacts = contact::get();
    }

    public function updatedSearch(){
        $this->contacts = contact::where('name','like',"%{$this->search}%")->orWhere('email','like',"%{$this->search}%")->get();
    }

    public function delete($id){
        contact::where('id',$id)->delete();

        $this->dispatch('contact-updated');
        $this->status = "Feed Back Deleted successfully!";
    }

    public function deleteStatus(){
        $this->status = '';
    }
};
?>

<div>
    @if($status)
        <div class="flex msg-box fixed right-3 bottom-16 z-111 items-center text-center mx-auto sm:max-w-md mt-6 shadow-md overflow-hidden sm:rounded-lg">
            <div class="w-full items-center p-3">
                {{$status}}
            </div>
            <x-danger-button wire:click="deleteStatus" onclick="closeMsg()">X</x-danger-button>
        </div>
    @endif

    <div class="flex justify-between max-w-7xl max-h-90 mx-auto bg-white shadow-md my-10 sm:rounded-lg">
        <x-text-input type="text" wire:model.live="search" placeholder="search..."/>
    </div>

    <div class="max-w-7xl max-h-90 mx-auto px-4 sm:px-6 lg:px-8 bg-white shadow-md my-10 sm:rounded-lg">
        <flux:table container:class="flex w-full max-h-90">
            <flux:table.columns sticky class="bg-white">
                <flux:table.column>ID</flux:table.column>
                <flux:table.column>Name</flux:table.column>
                <flux:table.column>Email</flux:table.column>
                <flux:table.column>Message</flux:table.column>
                <flux:table.column>Remove</flux:table.column>
            </flux:table.columns>

            @php
                $counter = 0;
            @endphp

            <flux:table.rows>
                @foreach ($contacts as $contact)
                <flux:table.row wire:key="contact-item-{{$contact['id']}}">
                    <flux:table.cell>{{++$counter}}</flux:table.cell>
                    <flux:table.cell>{{$contact['name']}}</flux:table.cell>
                    <flux:table.cell>{{$contact['email']}}</flux:table.cell>
                    <flux:table.cell>{{$contact['message']}}</flux:table.cell>
                    <flux:table.cell>  
                        <x-primary-button wire:click="delete({{$contact['id']}})">X</x-primary-button>
                    </flux:table.cell>
                </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>
    </div>
</div>