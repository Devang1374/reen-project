@extends('layouts.mylayout')

@section('title', 'Contact Us')

@section('content')

@session('success')
    <div class="message-box" style="dispaly:flex">
            <h1>{{$value}}</h1>
            <button onclick="closeMsgBox()">X</button>
    </div>
@endsession


<div class="main-section contact-us">
    <div class="container">
        <div class="contact-us-wrapper">
            
            
            <form method="POST" action="{{route('sendmail')}}">
        <h1>Contact Us</h1>
        @csrf {{-- Cross-Site Request Forgery protection --}}
        <div>
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required placeholder="User Name..."><br>
        </div>
        
        <div>
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required placeholder="youremail@example.com"><br>
        </div>

        <div>
            <label for="message">Message:</label><br>
            <textarea id="message" name="message" required placeholder="Write Your message here..."></textarea><br>
        </div>

        <input type="submit" id="submitBtn" value="Submit">
    </form>
        </div>
    </div>
</div>

@endsection