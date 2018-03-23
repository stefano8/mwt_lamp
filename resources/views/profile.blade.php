@extends('frame')


@section('content')

    <main class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>Profile</span>
            </div>
        </div>

        <div class="fullwidth-block">
            <div class="container">

                <div class="col-md-6 col-md-offset-3">
                    <h2 class="section-title">MyProfile</h2>
                    <form action="#" class="contact-form">
                            <div class="col-md-6"><img style="height: 150px; width: 150px;" src="images/user.png" ></div>
                        <div class="row">
                            <div class="col-md-6"><input type="text" disabled value="{{$userName->name}}"></div>
                            <div class="col-md-6"><input type="text" disabled value="{{$userName->email}}"></div>
                        </div>
                    </form>
                </div>


                <div class="col-md-12 col-md-offset-1">
                    <br><br><br><h2 class="section-title">Itinerary Collection</h2>

                        <div class="row">
                        <div class="col-sm-6">
                             @foreach($arrayImageC as $arrayImages)


                                    <img src="{{$arrayImages}}"  alt="foto" style="width: 300px; height: 223px;">
                                &nbsp;   &nbsp;

                            @endforeach
                        </div>



                        <div class="col-sm-6">
                            @foreach($arrayItinerary as $arrayItinerarys)

                                      <a href="/mwt_1718/public/itinerario/{{$arrayItinerarys}}">{{$arrayItinerarys}}</a>
                            &nbsp;   &nbsp;

                            @endforeach
                        </div>
                        </div>
                        </div>


                <div class="col-md-12 col-md-offset-1">
                    <br><br><br><h2 class="section-title">Itinerary Wishlist</h2>

                    <div class="row">
                        <div class="col-sm-6">
                            @foreach($arrayImageW as $arrayImageWs)


                                <img src="{{$arrayImageWs}}"  alt="foto" style="width: 300px; height: 223px;">
                                &nbsp;   &nbsp;

                            @endforeach
                        </div>



                        <div class="col-sm-6">
                            @foreach($arrayItineraryW as $arrayItineraryWs)

                                <a href="/mwt_1718/public/itinerario/{{$arrayItineraryWs}}">{{$arrayItineraryWs}}</a>
                                &nbsp;   &nbsp;

                            @endforeach
                        </div>
                    </div>
                </div>



                </div>
        </div>

    </main> <!-- .main-content -->

@endsection