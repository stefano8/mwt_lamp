@extends('frame')


@section('content')

    <main class="main-content">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html">Home</a>
                <span>{{trans('words.events')}}</span>
            </div>
        </div>

        <div style="height: 60%; width:100%; margin-top: 20px;" class="hero" data-bg-image="{!! asset('images/eventi3.jpg') !!}">
            <div class="boxtesto" style=" margin-left: 1100px; margin-right: 1px;">
                <h1 style="margin-top: -67px;">
                    <span class="testo" style="color: black; margin-left: -149px;">Quando uomini e montagne si incontrano,</span>
                    <span style="color: black; margin-left: 63px;"><br> grandi cose accadono <br></span>
                    <span style="color: black; margin-left: 150px;"> <i>William Blake</i></span>

                </h1>
            </div>
        </div>

        <div class="fullwidth-block">
            <div class="container">

        <div class="fullwidth-block" data-bg-color="#262936">
            <div class="container">

                <h1 style="text-align: center; font-size: 50px;">Eventi</h1>

                @foreach($event as $events)
                    <div class="row">
                    <div class="col-md-12 post">

                            <div class="col-md-3 photo-preview photo-detail">
                                <h1 style="margin:1px 22px 20px; color: #c8b7a5; padding-top: 50px;">{{$events->date}}</h1>

                                @if(!isset($events->eventImage()->first()->path))
                                    <img style="width: 195px; height: 190px;" src="{!! asset('images/calendar.png') !!}">
                                @else


                                  <img id="myImg" onclick="showImage(this)" src="{{$events->eventImage()->first()->path}}" alt="foto" style="width: 175px; height: 190px;">

                                    <div id="myModal" class="modal">
                                        <span class="close">&times;</span>
                                        <img class="modal-content" id="img01">

                                        <div id="caption"></div>
                                    </div>

                                @endif
                            </div>
                            <div clas="col-md-4">
                       <!-- <a  style="" href="{{route('event.single', $events->id)}}">-->
                           <button class="collapsible1" style="background-color: transparent; margin-left: 40px;  margin-top: 54px;"  title="Clicca per vedere i dettagli dell'evento">

                               <h1 style="color: white; margin:1px 22px 20px; padding-top: 19px; overflow: hidden; white-space: nowrap; width: 500px; text-align: center;"><a class="hover_color">{{$events->title}}</a></h1></button>

                              <div class="content1">

                                 <p style="margin:1px 22px 20px; padding-top: 2px; font-size: 18px; width: 600px;">{{$events->body}}</p>
                              </div>


                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
                    </div>


            </div>

    </main> <!-- .main-content -->
<script>

    /*var modal = document.getElementById('myModal');

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById('myImg');
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function(){
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }*/


    var modal = document.getElementById('myModal');
    var modalImg = document.getElementById('img01');
    var captionText = document.getElementById("caption");


    function showImage(imgElement) {
        var src = imgElement.getAttribute("src");
        modal.style.display = "block";

        modalImg.src = src;


    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }



    var coll = document.getElementsByClassName("collapsible1");
    var i;

    for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var content = this.nextElementSibling;
            if (content.style.display === "block") {
                content.style.display = "none";
            } else {
                content.style.display = "block";
            }
        });
    }
</script>

@endsection