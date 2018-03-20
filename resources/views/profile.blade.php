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
                            <div class="col-md-6"><input type="text" value="stefano"></div>
                            <div class="col-md-6"><input type="text" value="Email "></div>
                        </div>
                    </form>
                </div>


                <div class="col-md-12 col-md-offset-1">
                    <br><br><br><h2 class="section-title">Itinerary Collection</h2>
                    <div class="">
                        <a href="#"><img src="{!! asset('images/thumb-1.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-2.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-3.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-4.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-5.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-6.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-7.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-8.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-9.jpg') !!}" alt="#"></a>

                        <a href="#"><img src="{!! asset('images/thumb-1.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-2.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-3.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-4.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-5.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-6.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-7.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-8.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-9.jpg') !!}" alt="#"></a>

                        <a href="#"><img src="{!! asset('images/thumb-1.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-2.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-3.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-4.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-5.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-6.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-7.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-8.jpg') !!}" alt="#"></a>
                        <a href="#"><img src="{!! asset('images/thumb-9.jpg') !!}" alt="#"></a>
                    </div>
                </div>
        </div>

    </main> <!-- .main-content -->

@endsection