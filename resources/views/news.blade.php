@extends('frame')


@section('content')

    <main class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>News</span>
            </div>
        </div>


        <div class="fullwidth-block">
            <div class="container">
                <div class="row">
                    <div class="content col-md-8">
                        @foreach($news as $newss)
                        <div class="post">
                                <h2 class="entry-title"><a href="/single/{{$newss->id}}">{{$newss->title}} ({{$newss->date}})</a></h2>
                                <div class="featured-image"><img src="" alt=""></div>
                                <p>{{$newss->body}}</p>
                                <a href="#" class="button">Read more</a>
                        </div>
                        @endforeach

                            <div style="margin-left: 50%; font-size: 15px; font-family: Verdana; ">{{$news->links('vendor.pagination.semantic-ui')}}</div>

                    </div>
                    <div class="sidebar col-md-3 col-md-offset-1">
                        <div class="widget">
                            <h3 class="widget-title">Hot News</h3>
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
                        <div style="margin-left: 50%; font-size: 15px; font-family: Verdana; ">{{$news->links('vendor.pagination.semantic-ui')}}</div>

                    </div>
                </div>

            </div>
        </div>
    </main> <!-- .main-content -->

@endsection