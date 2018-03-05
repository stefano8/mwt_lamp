@extends('frame')


@section('content')

    <main class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>Contact</span>
            </div>
        </div>

        <div class="fullwidth-block">
            <div class="container">
                <div class="col-md-5">
                    <div class="contact-details">
                        <div class="map" data-latitude="-6.897789" data-longitude="107.621735"></div>
                        <div class="contact-info">
                            <address>
                                <img src="images/icon-marker.png" alt="">
                                <p>Company Name INC. <br>
                                    2803 Avenue Street, Los Angeles</p>
                            </address>

                            <a href="#"><img src="images/icon-phone.png" alt="">+1 800 314 235</a>
                            <a href="#"><img src="images/icon-envelope.png" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-1">
                    <h2 class="section-title">Contact us</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi consectetur inventore ducimus, facilis, numquam id soluta omnis eius recusandae nesciunt vero repellat harum cum. Nisi facilis odit hic, ipsum sed!</p>
                    <form action="#" class="contact-form">
                        <div class="row">
                            <div class="col-md-6"><input type="text" placeholder="Your name..."></div>
                            <div class="col-md-6"><input type="text" placeholder="Email Addresss..."></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><input type="text" placeholder="Company name..."></div>
                            <div class="col-md-6"><input type="text" placeholder="Website..."></div>
                        </div>
                        <textarea name="" placeholder="Message..."></textarea>
                        <div class="text-right">
                            <input type="submit" placeholder="Send message">
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </main> <!-- .main-content -->

@endsection