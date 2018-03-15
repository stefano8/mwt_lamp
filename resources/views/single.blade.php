@extends('frame')


@section('content')



    <div class="fullwidth-block">
        <div class="container">
            <div class="row">
                <div class="content col-md-8">
                    <div class="post single">
                        @if($itinerary !== NULL)
                            <h2 class="entry-title">{{$itinerary->name}}</h2>
                            <div class="featured-image">
                                @foreach($image as $images)
                                <figure class="live-camera-cover">
                                    <img src="{{$images->path}}" alt="foto">
                                </figure>
                                @endforeach
                            </div>

                            <div class="entry-content">
                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores.</p>

                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur.</p>

                                <blockquote>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati iusto minima, iste doloremque culpa blanditiis mollitia nisi aliquid illum accusantium numquam. Pariatur, velit. Sapiente ipsum excepturi sunt, eveniet eaque, qui?</p>
                                </blockquote>

                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum.</p>

                                <p>Dlorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit beatae vitae dicta sunt explicabo e veritatis et quasi architecto beatae vitae dicta sunt explicabo earum rerum.</p>
                            </div>
                        @endif

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
                    <div class="col-md-6 col-md-offset-1">
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
                        <h3 class="widget-title">News</h3>
                        <ul class="arrow-list">
                            <li><a href="#">Accusamus dignissimos</a></li>
                            <li><a href="#">Ducimus praesentium</a></li>
                            <li><a href="#">Voluptatum deleniti corrupti</a></li>
                            <li><a href="#">Wuos dolores excepturi sint</a></li>
                            <li><a href="#">Occaecati provident dolor</a></li>
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