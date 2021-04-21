@extends('layouts.front-end.app')

@section('content')
    <section class="slider_section">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">

                    <div class="container-fluid padding_dd">
                        <div class="carousel-caption">
                            <div class="row">
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                                    <div class="text-bg">
                                        <h1>Search your Favorite Course here</h1>
                                        <p>TOP NOTCH COURSES FROM TRAINED PROFESSIONALS</p>
                                        <a href="#">Read more</a> <a href="#">get a qoute</a>
                                    </div>
                                </div>
                                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                                    <div class="images_box">
                                        <figure><img src="assets/front-end/images/img2.png"></figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">

                    <div class="container-fluid padding_dd">
                        <div class="carousel-caption">

                            <div class="row">
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                                    <div class="text-bg">
                                        <h1>Search your Favorite Course here</h1>
                                        <p>TOP NOTCH COURSES FROM TRAINED PROFESSIONALS</p>
                                        <a href="#">Read more</a><a href="#">get a qoute</a>
                                    </div>
                                </div>

                                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                                    <div class="images_box">
                                        <figure><img src="assets/front-end/images/img2.png"></figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="carousel-item">

                    <div class="container-fluid padding_dd">
                        <div class="carousel-caption ">
                            <div class="row">
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                                    <div class="text-bg">
                                        <h1>Search your Favorite Course here</h1>
                                        <p>TOP NOTCH COURSES FROM TRAINED PROFESSIONALS</p>
                                        <a href="#">Read more</a> <a href="#">get a qoute</a>
                                    </div>
                                </div>
                                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                                    <div class="images_box">
                                        <figure><img src="assets/front-end/images/img2.png"></figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>

    </section>
    <!-- about  -->
    <div id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="about-box">
                        <h2>About <strong class="yellow">Our Game</strong></h2>
                        <p> orem ipsum dolor sit amet, consectetur adipisicing elit. Quas voluptatem maiores eaque similique non distinctio voluptates perspiciatis omnis, repellendus ipsa aperiam, laudantium voluptatum nulla?.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta, assumenda, vo
                            luptatum. Libero eligendi molestias iure error animi totam laudantium, aspernatur similique id eos at consectetur illo culpa,  </p>
                        <a href="Javascript:void(0)">Read more</a>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="about-box">
                        <figure><img src="assets/front-end/images/about.jpg" alt="#" /></figure>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end abouts -->



    <!-- our -->
    <div id="important" class="important">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="titlepage">
                        <h2>Some <strong class="yellow">important facts</strong></h2>
                        <span>luptatum. Libero eligendi molestias iure error animi totam laudantium, aspernatur similique id eos a
          t consectetur illo culpa,</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="important_bg">
            <div class="container">
                <div class="row">

                    <div class="col col-xs-12">
                        <div class="important_box">
                            <h3>200+</h3>
                            <span>Teachers</span>
                        </div>
                    </div>
                    <div class="col col-xs-12">
                        <div class="important_box">
                            <h3>20+</h3>
                            <span>Colleges</span>
                        </div>
                    </div>
                    <div class="col col-xs-12">
                        <div class="important_box">
                            <h3>50+</h3>
                            <span>Courses</span>
                        </div>
                    </div>
                    <div class="col col-xs-12">
                        <div class="important_box">
                            <h3>200+</h3>
                            <span>Members</span>
                        </div>
                    </div>
                    <div class="col col-xs-12">
                        <div class="important_box">
                            <h3>10+</h3>
                            <span>countries</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
