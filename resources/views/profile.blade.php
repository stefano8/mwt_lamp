@extends('frame')


@section('content')

    <main class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>{{trans('words.profile')}}</span>
            </div>
        </div>

        <div class="fullwidth-block">
            <div class="container">


                <div class="col-md-6 col-md-offset-3 post">
                    <h2 class="section-title">{{trans('words.myprofile')}}</h2>


                    <div class="panel-body">


                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    </div>


                    <form action="#" class="contact-form">
                        @if(!isset($user->userImage()->first()->path))
                            <div class="col-md-6"><img style="height: 150px; width: 150px;" src="/images/profile.png"></div>
                        @else

                            <div class="col-md-6"><img style="height: 150px; width: 150px;" src="{{$user->userImage()->first()->path}}"></div>

                        @endif
                        <div class="row">
                            <div class="col-md-6"><input type="text" disabled value="{{$userName->name}}"></div>
                            <div class="col-md-6"><input type="text" disabled value="{{$userName->email}}"></div>
                        </div>
                    </form>


                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <strong>{{ $message }}</strong>
                        </div>
                       {{--<img src="/images/{{ Session::get('path') }}">--}}
                    @endif
                    <form action="{{ url('image-upload', $user->id) }}" enctype="multipart/form-data" method="POST">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <input type="file" name="image" />
                            </div>
                            <div class="col-md-12">
                                &nbsp;&nbsp; <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="col-md-12 col-md-offset-1 post">
                    <br><br><br><h2 class="section-title">I{{trans('words.collections')}}</h2>

                        <div class="row">
                        <div>
                             @foreach($arrayImageC as $arrayImages)
                                <img src="{{$arrayImages}}"  alt="foto" style="width: 100px; height: 100px;">
                                &nbsp;   &nbsp;
                            @endforeach
                        </div>



                        <div class="col-sm-6">
                            @foreach($arrayItinerary as $arrayItinerarys)
                                      <a href="/itinerario/{{$arrayItinerarys}}">{{$arrayItinerarys}}</a>
                            &nbsp;   &nbsp;
                            @endforeach
                        </div>
                        </div>
                        </div>


                <div class="col-md-12 col-md-offset-1 post">
                    <br><br><br><h2 class="section-title">Wishlist</h2>

                        <div style="">
                            @foreach($arrayImageW as $arrayImageWs)
                                <img src="{{$arrayImageWs}}"  alt="foto" style="width: 100px; height: 100px;">
                                &nbsp;   &nbsp;
                            @endforeach

                            @foreach($arrayItineraryW as $arrayItineraryWs)
                                <a href="itinerario/{{$arrayItineraryWs}}">{{$arrayItineraryWs}}</a>
                                &nbsp;   &nbsp;
                            @endforeach
                        </div>
                    </div>
                </div>



                </div>
        </div>

    </main> <!-- .main-content -->

@endsection