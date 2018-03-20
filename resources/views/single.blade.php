<!-- Font Awesome Icon Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .checked {
        color: orange;
    }
</style>

@extends('frame')


@section('content')


    <div class="fullwidth-block">
        <div class="container">
            <div class="row">
                <div class="content col-md-8">
                    <div class="post single">
<!--per media voti-->
                        <div class="col-md-12">
                            <p>All Votes:
                                <a href="#" id="1" name="1">
                                    <span id="1" class="fa fa-star checked"></span>
                                </a>
                                <a href="#" id="2" name="2">
                                    <span id="2" class="fa fa-star checked"></span>
                                </a>
                                <a href="#" id="3" name="3">
                                    <span id="3" class="fa fa-star"></span>
                                </a>
                                <a href="#" id="4" name="4">
                                    <span id="4" class="fa fa-star"></span>
                                </a>
                                <a href="#" id="5" name="5">
                                    <span id="5" class="fa fa-star"></span>
                                </a>
                            </p>
                        </div>
<!--per inserire voti-->
                        <div class="col-md-12">
                            <p>Your Vote:
                                <a href="#" id="1" name="1">
                                    <span id="1" class="fa fa-star "></span>
                                </a>
                                <a href="#" id="2" name="2">
                                    <span id="2" class="fa fa-star "></span>
                                </a>
                                <a href="#" id="3" name="3">
                                    <span id="3" class="fa fa-star"></span>
                                </a>
                                <a href="#" id="4" name="4">
                                    <span id="4" class="fa fa-star"></span>
                                </a>
                                <a href="#" id="5" name="5">
                                    <span id="5" class="fa fa-star"></span>
                                </a>
                            </p>
                        </div>
                        @if($itinerary !== NULL)
                            <h2 class="entry-title">{{$itinerary->name}}</h2>
                            <div class="featured-image">
                                @foreach($image as $images)
                                <figure class="live-camera-cover">
                                    <img src="{{$images->path}}" alt="foto" style="width: 300px; height: 223px;"> {{--src="{{URL::asset($images->path)}}"--}}

                                </figure>
                                @endforeach

                            </div>

                            <div class="entry-content">
                                <p>{{$itinerary->description}}</p>
                            </div>
                        @endif

                        {{--@if($wishlist )--}}
                            <div class="col-sm-9">
                            <a class="fa fa-heart button" href="{{route('itinerary.addwishlist', $itinerary->id)}}">Add to wishlist</a>
                            </div>
                        {{--@else()--}}
                            <div class="col-sm-9">
                                <a class="fa fa-heart button" href="{{route('itinerary.removewishlist', $itinerary->id)}}">Remove from wishlist</a>
                            </div>
                        {{--@endif--}}
                            <div class="col-sm-3">
                                <a class="fa fa-check button" href="">marks as already seen</a>
                            </div>
                    </div>




<!--form per inserire recensione-->
                    <div class="col-md-6 col-md-offset-1">
                        <h2 class="section-title">Write review</h2>
                        <form action="{{route('review.insert', $itinerary->id)}}" class="contact-form">
                            <div class="row">
                                <div class="col-md-12">
                                    <input style="width: 200%;" name="title" id="title" type="text" placeholder="Title"></div>
                            </div>
                            <textarea style="width: 200%;" name="body" id="body" placeholder="Message..."></textarea>

                            <div class="text-right">
                                <input type="submit" placeholder="Send review">
                            </div>
                        </form>
                    </div>




<!--per vedere tutte le recensioni-->
                    <div class="col-md-9 ">
                        <h2 class="section-title">All Review</h2>
                        @foreach($review as $reviews)
                        <form action="#" class="contact-form" style="width: 200%;" >
                            <div class="sidebar col-md-122">
                                <div class="widget top-rated">
                                    <ul>
                                        <li>
                                            <div class="rating">
                                                <strong>{{$reviews->title}}</strong>
                                            </div>
                                            <h3 class="entry-title">
                                                <a href="#">{{$reviews->body}}</a>
                                            </h3>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>





                <div class="sidebar col-md-3 col-md-offset-1">
                    <div class="widget">
                        <h3 class="widget-title">Features</h3>
                        <ul class="arrow-list">
                            <li><a href="#">Difficolty: {{$itinerary->difficolty}}</a></li>
                            <li><a href="#">Difference: {{$itinerary->difference}}</a></li>
                            <li><a href="#">Duration: {{$itinerary->duration}}</a></li>
                        </ul>
                    </div>

                    <div class="widget">
                        <h3 class="widget-title">Categories</h3>
                        <ul class="arrow-list">
                            <li><a href="#">Nemo enim ipsam</a></li>
                            <li><a href="#">Voluptatem voluptas</a></li>
                            <li><a href="#">Aspernatur aut odit</a></li>
                            <li><a href="#">Consequuntur magni</a></li>
                            <li><a href="#">Dolores ratione</a></li>
                            <li><a href="#">Voluptatem nesciunt</a></li>
                            <li><a href="#">Neque porro quisquam</a></li>
                            <li><a href="#">Dolorem ipsum quia</a></li>
                        </ul>
                    </div>

                    <div class="widget top-rated">
                        <h3 class="widget-title">Top rated posts</h3>
                        <ul>
                            <li><h3 class="entry-title"><a href="#">Doloremque laudantium lorem</a></h3><div class="rating"><strong>5.5</strong> (759 rates)</div></li>
                            <li><h3 class="entry-title"><a href="#">Doloremque laudantium lorem</a></h3><div class="rating"><strong>5.5</strong> (759 rates)</div></li>
                            <li><h3 class="entry-title"><a href="#">Doloremque laudantium lorem</a></h3><div class="rating"><strong>5.5</strong> (759 rates)</div></li>
                            <li><h3 class="entry-title"><a href="#">Doloremque laudantium lorem</a></h3><div class="rating"><strong>5.5</strong> (759 rates)</div></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </main> <!-- .main-content -->


@endsection