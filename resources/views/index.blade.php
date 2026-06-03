@extends('layouts.mylayout')

@section('title', 'HOME PAGE')

@section('content')
    <div class="main">
        <!-- hero section -->
        <div id="splide1" class="splide " aria-label="Basic Example">
            <div class="splide__track ">
                <ul class="splide__list">
                    @foreach($heros as $hero)
                    <li class="splide__slide">
                        <div class="hero main-section">
                            <img src="{{asset('Storage')}}/{{$hero['file-path']}}" alt="">
                            <div class="container">
                                <h1>{{$hero['title']}}</h1>
                                <div class="hero-wrapper">
                                    <p>{{$hero['caption']}}</p>
                                   <a href="{{$hero['btn-url']}}"><button>{{$hero['btn-text']}}</button></a>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>  
        </div>
        <!-- hero section end -->

        <div id="features" class="about-us main-section">
            @php
                $records = json_decode($pages,true);
                $index = array_search('Features', array_column($records, 'slug'));
            @endphp
            <div class="about-us-wrapper">
                <h2>{{$records[$index]['title']}}</h2>
                <div class="main-text">
                    <p>{{$records[$index]['caption']}}</p>
                </div>
                <div class="features">
                    @foreach ($features as $feature)
                    <div class="feature">
                        <div class="logo">
                            <i class="fa fa-{{$feature['icon']}}"></i>
                        </div>
                        <div class="text">
                            <h3>{{$feature['title']}}</h3>
                            <p>{{$feature['caption']}}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- who we are end -->

        <!-- latest works -->
        <div id="portfolio" class="works main-section">
            <div class="works-wrapper">
                <div class="text">
                    @php
                        $records = json_decode($pages,true);
                        $index = array_search('portfolio', array_column($records, 'slug'));
                    @endphp
                    <h2>{{$records[$index]['title']}}</h2>
                    <p>{{$records[$index]['caption']}}</p>
                </div>

                <div class="big-works">
                    @foreach($portfolios as $portfolio)
                    @if($portfolio['isActive'])
                    <div class="work">
                        <div class="figure">
                            <img src="{{asset('Storage')}}/{{$portfolio['file-path']}}" alt="">
                            <div class="plus-icon">
                                <p>+</p>
                            </div>
                        </div>
                        <div class="caption">
                            <h3>{{$portfolio['title']}}</h3>
                            <p>{{$portfolio['category']}}</p>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                <div class="carousel">
                    <div id="splide2" class="splide" aria-label="Basic Example">
                        <div class="splide__track ">
                            <ul class="splide__list">
                                @foreach($portfolios as $portfolio)
                                @if(!$portfolio['isActive'])
                                <li class="splide__slide">
                                    <div class="img-container">
                                        <img src="{{asset('Storage')}}/{{$portfolio['file-path']}}" alt="">
                                        <div class="caption">
                                            <h5>{{$portfolio['title']}}</h5>
                                            <p>{{$portfolio['category']}}</p>
                                        </div>
                                    </div>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="my-slider-progress">
                            <div class="my-slider-progress-bar"></div>
                        </div>
                    </div>
                </div>

                <div class="carousel-nav">
                    <span></span>
                    <span class="selected"></span>
                    <span></span>
                </div>
            </div>
        </div>
        <!-- latest works end -->

        <!-- get in touch -->
        <div id="contact" class="get-in-touch main-section">
            <div class="container">
                <div class="get-in-touch-wrapper">
                    @php
                        $records = json_decode($pages,true);
                        $index = array_search('Contact', array_column($records, 'slug'));
                    @endphp
                    <h2>{{$records[$index]['title']}}</h2>
                    <p>{{$records[$index]['caption']}}</p>
                    <a href="{{$records[$index]['btnUrl']}}"><button>{{$records[$index]['btnText']}}</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection