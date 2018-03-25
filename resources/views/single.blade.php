@extends('frame')


@section('content')

    <!-- Font Awesome Icon Library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .checked {
            color: orange;
        }
    </style>

    <div class="fullwidth-block">
        <div class="container">
            <div class="row">
                <div class="content col-md-8">
                    <div class="post single">

                        <!--per media voti-->

                        @if($itinerary !== NULL)
                            <h2 class="entry-title">{{$itinerary->name}}

                                @if($media == '0')
                                    <a>
                                        <span id="1" class="fa fa-star "></span>
                                    </a>
                                    <a>
                                        <span id="2" class="fa fa-star "></span>
                                    </a>
                                    <a>
                                        <span id="3" class="fa fa-star"></span>
                                    </a>
                                    <a>
                                        <span id="4" class="fa fa-star"></span>
                                    </a>
                                    <a>
                                        <span id="5" class="fa fa-star"></span>
                                    </a>

                                @elseif($media == '1')
                                    <a class="checked">
                                        <span id="1" class="fa fa-star "></span>
                                    </a>
                                    <a>
                                        <span id="2" class="fa fa-star "></span>
                                    </a>
                                    <a>
                                        <span id="3" class="fa fa-star"></span>
                                    </a>
                                    <a>
                                        <span id="4" class="fa fa-star"></span>
                                    </a>
                                    <a>
                                        <span id="5" class="fa fa-star"></span>
                                    </a>

                                @elseif($media == '2')
                                    <a class="checked">
                                        <span id="1" class="fa fa-star "></span>
                                    </a>
                                    <a class="checked">
                                        <span id="2" class="fa fa-star "></span>
                                    </a>
                                    <a>
                                        <span id="3" class="fa fa-star"></span>
                                    </a>
                                    <a>
                                        <span id="4" class="fa fa-star"></span>
                                    </a>
                                    <a>
                                        <span id="5" class="fa fa-star"></span>
                                    </a>

                                @elseif($media == '3')
                                    <a class="checked">
                                        <span id="1" class="fa fa-star "></span>
                                    </a>
                                    <a class="checked">
                                        <span id="2" class="fa fa-star "></span>
                                    </a>
                                    <a class="checked">
                                        <span id="3" class="fa fa-star"></span>
                                    </a>
                                    <a>
                                        <span id="4" class="fa fa-star"></span>
                                    </a>
                                    <a>
                                        <span id="5" class="fa fa-star"></span>
                                    </a>

                                @elseif($media == '4')
                                    <a class="checked">
                                        <span id="1" class="fa fa-star "></span>
                                    </a>
                                    <a class="checked">
                                        <span id="2" class="fa fa-star "></span>
                                    </a>
                                    <a class="checked">
                                        <span id="3" class="fa fa-star"></span>
                                    </a>
                                    <a class="checked">
                                        <span id="4" class="fa fa-star"></span>
                                    </a>
                                    <a>
                                        <span id="5" class="fa fa-star"></span>
                                    </a>

                                @elseif($media)
                                    <a class="checked">
                                        <span id="1" class="fa fa-star "></span>
                                    </a>
                                    <a class="checked">
                                        <span id="2" class="fa fa-star "></span>
                                    </a>
                                    <a class="checked">
                                        <span id="3" class="fa fa-star"></span>
                                    </a>
                                    <a class="checked">
                                        <span id="4" class="fa fa-star"></span>
                                    </a>
                                    <a class="checked">
                                        <span id="5" class="fa fa-star"></span>
                                    </a>
                                @endif
                            </h2>

                            <div class="featured-image">
                                @foreach($image as $images)
                                    <figure class="live-camera-cover">
                                        <img src="{{$images->path}}" alt="foto"
                                             style="width: 300px; height: 223px;"> {{--src="{{URL::asset($images->path)}}"--}}

                                    </figure>
                                @endforeach

                            </div>

                            <div class="entry-content">
                                <p>{{$itinerary->description}}</p>
                            </div>
                        @endif


                    @if(!($bottoneWishlist))
                        <div class="col-sm-6">
                            <a class="fa fa-heart button" href="{{route('itinerary.addwishlist', $itinerary->id)}}">Add
                                to wishlist</a>
                        </div>
                        @else
                        <div class="col-sm-6">
                            <a class="fa fa-heart button"
                               href="{{route('itinerary.removewishlist', $itinerary->id, $user->id)}}">Remove from
                                wishlist</a>
                        </div>
                    @endif

                    @if(!($bottoneCollection))
                        <div class="col-sm-6">
                            <a class="fa fa-check button" href="{{route('itinerary.addcollection', $itinerary->id)}}">Marks
                                as already seen</a>
                        </div>
                        @else
                        <div class="col-sm-6">
                            <a class="fa fa-heart button"
                               href="{{route('itinerary.removecollection', $itinerary->id, $user->id)}}">Unseen</a>
                        </div>
                    @endif
                    </div>


                    <!--form per inserire recensione-->
                    <div class="col-md-6 col-md-offset-1" style="margin-top: 50px;">


                        <h2 class="section-title">Write review</h2>
                        <form action="{{route('review.insert', $itinerary->id)}}" class="contact-form">
                            <div class="row">
                                <div class="col-md-12">
                                    <input style="width: 200%;" name="title" id="title" type="text" placeholder="Title">
                                </div>
                            </div>
                            <textarea style="width: 200%;" name="body" id="body" placeholder="Message..."></textarea>

                            <div class="text-right">
                                <input type="submit" placeholder="Send review">
                            </div>
                        </form>
                    </div>


                    <!--per inserire voti-->
                    <div class="col-md-6 col-md-offset-4 " style="margin-top: 50px;">
                        <h1>Your Vote:
                            @if($voteUser == null)
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/1" id="1" name="1">
                                    <span id="1" class="fa fa-star "></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/2" id="2" name="2">
                                    <span id="2" class="fa fa-star "></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/3" id="3" name="3">
                                    <span id="3" class="fa fa-star"></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/4" id="4" name="4">
                                    <span id="4" class="fa fa-star"></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/5" id="5" name="5">
                                    <span id="5" class="fa fa-star"></span>
                                </a>

                            @elseif($voteUser->vote == '1')
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/1" id="1" name="1" class="checked">
                                    <span id="1" class="fa fa-star "></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/2" id="2" name="2">
                                    <span id="2" class="fa fa-star "></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/3" id="3" name="3">
                                    <span id="3" class="fa fa-star"></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/4" id="4" name="4">
                                    <span id="4" class="fa fa-star"></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/5" id="5" name="5">
                                    <span id="5" class="fa fa-star"></span>
                                </a>

                            @elseif($voteUser->vote == '2')
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/1" id="1" name="1" class="checked">
                                    <span id="1" class="fa fa-star "></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/2" id="2" name="2" class="checked">
                                    <span id="2" class="fa fa-star "></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/3" id="3" name="3">
                                    <span id="3" class="fa fa-star"></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/4" id="4" name="4">
                                    <span id="4" class="fa fa-star"></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/5" id="5" name="5">
                                    <span id="5" class="fa fa-star"></span>
                                </a>

                            @elseif($voteUser->vote == '3')
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/1" id="1" name="1" class="checked">
                                    <span id="1" class="fa fa-star "></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/2" id="2" name="2" class="checked">
                                    <span id="2" class="fa fa-star "></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/3" id="3" name="3" class="checked">
                                    <span id="3" class="fa fa-star"></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/4" id="4" name="4">
                                    <span id="4" class="fa fa-star"></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/5" id="5" name="5">
                                    <span id="5" class="fa fa-star"></span>
                                </a>

                            @elseif($voteUser->vote == '4')
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/1" id="1" name="1" class="checked">
                                    <span id="1" class="fa fa-star "></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/2" id="2" name="2" class="checked">
                                    <span id="2" class="fa fa-star "></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/3" id="3" name="3" class="checked">
                                    <span id="3" class="fa fa-star"></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/4" id="4" name="4" class="checked">
                                    <span id="4" class="fa fa-star"></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/5" id="5" name="5">
                                    <span id="5" class="fa fa-star"></span>
                                </a>

                            @elseif($voteUser->vote == '5')
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/1" id="1" name="1" class="checked">
                                    <span id="1" class="fa fa-star "></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/2" id="2" name="2" class="checked">
                                    <span id="2" class="fa fa-star "></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/3" id="3" name="3" class="checked">
                                    <span id="3" class="fa fa-star"></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/4" id="4" name="4" class="checked">
                                    <span id="4" class="fa fa-star"></span>
                                </a>
                                <a href="/single/{{$itinerary->id}}/{{$user->id}}/5" id="5" name="5" class="checked">
                                    <span id="5" class="fa fa-star"></span>
                                </a>
                            @endif
                        </h1>
                    </div>


                    <!--per vedere tutte le recensioni-->
                    <div class="col-md-9 " style="margin-top: 50px;">
                        <h2 class="section-title">All Review</h2>
                        @foreach($review as $reviews)
                            <form action="#" class="contact-form" style="width: 200%;">
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
                            @foreach($category as $categories)
                                <li><a href="/mwt_1718/public/itine/{{$categories->id}}">{{$categories->name}}</a></li>
                            @endforeach

                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </main> <!-- .main-content -->
@endsection