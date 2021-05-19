@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="background: white">
            <div class="row text-center" style="background-color: white">

                <h1>Welcome to PSV</h1>
                <h2 class="text-muted">Leading education provider on the web</h2>

            </div>

            <div class="row" style=" background: white; margin-top: 50px; margin-bottom: 100px;">
                <img src="img/background.jpg" class="img-responsive" alt="">
            </div>
            <div class="row" style="background-color: white">
                <div class="col-md-4 text-center">
                    <div class="row">
                        <div class="col-md-10"><span class="title" style="font-size: 20pt">About us</span></div>
                        <div class="col-md-2"><img src="img/info.png" class="img-responsive"   alt=""></div>
                    </div>
                    <hr>
                    <p class="text-justify">PSV is an education company. But not one in the way you might think. We're committed to
                        building the best learning experience inside and out, making PSV the best place
                        for our team to learn, teach, and create the online learning experience of the future.</p>

                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-10"><span class="title" style="font-size: 20pt">Subscribe</span></div>
                        <div class="col-md-2"><img src="img/link.png" class="img-responsive"   alt=""></div>
                    </div>
                    <hr>
                    <p class="text-justify">Subscribe for only $9.99/mo and get unlimited premium educational content.
                    PSV provides rich content for learners and professionals of every skill level. Make PSV your first
                    stop on your learning journey. </p>
                </div>
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-10"><span class="title" style="font-size: 20pt">Contribute</span></div>
                        <div class="col-md-2"><img src="img/diploma.png" class="img-responsive"   alt=""></div>
                    </div>
                    <hr>
                    <p class="text-justify">Send us your resume and we will consider adding you to our contributor list.
                    Let this be the best opportunity to share your knowledge and earn additional income. We promise to
                        provide you with industry leading earning oportunities.
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection