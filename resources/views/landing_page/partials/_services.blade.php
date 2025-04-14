<div class="container-xxl bg-white p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow" style="text-decoration: #42CD34; width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Button trigger modal -->
<!--button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Launch modal
</button-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Digital Cleaning Solution</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--- add your video code here --->
        <video id="myVideo" width="470" height="440" style="margin-left: 10px" autoplay controls >
            <source src="{{asset('images/DCS Video.mp4')}}" type="video/mp4">
        </video>
      </div>
      <div class="modal-footer">
        <!--button type="button" class="btn btn-secondary" data-dismiss="modal"><span aria-hidden="true">&times;</span>Close</button-->
      </div>
    </div>
  </div>
</div>



    <!-- Navbar & Hero Start -->
    <div class="container-xxl position-relative p-0" id="home">
        @include('landing_page.partials._topbar')

        <div style="background-color: #42CD34;" class="container-xxl hero-header">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 text-center text-lg-start">
                        <h1 class="text-white mb-4 animated slideInDown">{{__('header.heading')}}</h1>
                        <p class="text-white pb-3 animated slideInDown">{{__('header.peragraph')}}</p>
                        <div class="position-relative w-100 mt-3">
                            <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" placeholder="{{__('header.your_email')}}" style="height: 58px;">
                            <a href="https://digitalcleansolution.com/register">
                            <button style="background-color: #42CD34; color: #FFFFFF;" type="button" class="btn rounded-pill py-2 px-3 shadow-none position-absolute top-0 end-0 m-2">{{__('header.free_trail')}}</button>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 text-center text-lg-start">
                        <img class="img-fluid rounded animated zoomIn" src="{{asset('new_landing_page/img/head-image.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar & Hero End -->


    <!-- Advanced Feature Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="mb-3">{{__('clients.heading')}}</h1>
                <section class="customer-logos slider">
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/akor-bouw.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/balast-nedam-logo-1-320x202.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/BAM-320x202.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Bebouw-Midreth.png')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/DuraVermeer-320x202.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Era-bouw.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Giesbers.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Heerkens-van-Bavel.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/heijmans-320x202.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Heutink.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Hillen-Roosen.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/HSB-Bouw-Logo.png')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Logo-Berghege.png')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Logo-Klok-Groep.png')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Logo-van-Arnhem-Bouwgroep.png')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/LOGO_HURKS-320x202.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Moonen.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Oomsbouw-logo.png')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Pellikaan.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Pleijsier-bouw.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Remmers.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Slokker.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/slokker-320x202.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Ten-Brinke.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Trebbe-bouw.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/van-de-Ven.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Van-Omme-en-De-Groot-320x202.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/van-schijndel.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/vast-bouw.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/VolkerWessels-320x202.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Vorm.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Waal.jpg')}}"></div>
                    <div class="slide"><img src="{{asset('new_landing_page/img/clients/Zublin.jpg')}}"></div>
                </section>
            </div>
        </div>
    </div>
    <!-- Advanced Feature End -->

    <!-- Advanced Feature Start -->
    <div class="container-xxl py-6" id="features">
        <div class="container">
            <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">{{__('why.heading')}}</h1>
                <p class="mb-5">{{__('why.sub_heading')}}</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="advanced-feature-item text-center rounded py-5 px-4">
                        <i style="color: #42CD34;" class="fa fa-edit fa-3x mb-4"></i>
                        <h5 class="mb-3">{{__('why.project')}}</h5>
                        <p class="m-0">{{__('why.project_description')}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="advanced-feature-item text-center rounded py-5 px-4">
                        <i style="color: #42CD34;" class="fa fa-sync fa-3x mb-4"></i>
                        <h5 class="mb-3">{{__('why.floor')}}</h5>
                        <p class="m-0">{{__('why.floor_description')}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="advanced-feature-item text-center rounded py-5 px-4">
                        <i style="color: #42CD34;" class="fa fa-laptop fa-3x mb-4"></i>
                        <h5 class="mb-3">{{__('why.reporting')}}</h5>
                        <p class="m-0">{{__('why.reporting_description')}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="advanced-feature-item text-center rounded py-5 px-4">
                        <i style="color: #42CD34;" class="fa fa-draw-polygon fa-3x mb-4"></i>
                        <h5 class="mb-3">{{__('why.project_cost')}}</h5>
                        <p class="m-0">{{__('why.project_cost_description')}}</p>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="advanced-feature-item text-center rounded py-5 px-4">
                        <i style="color: #42CD34;" class="fa fa-edit fa-3x mb-4"></i>
                        <h5 class="mb-3">{{__('why.web_mobile')}}</h5>
                        <p class="m-0">{{__('why.web_mobile_description')}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="advanced-feature-item text-center rounded py-5 px-4">
                        <i style="color: #42CD34;" class="fa fa-sync fa-3x mb-4"></i>
                        <h5 class="mb-3">{{__('why.staff_timing')}}</h5>
                        <p class="m-0">{{__('why.staff_timing_description')}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="advanced-feature-item text-center rounded py-5 px-4">
                        <i style="color: #42CD34;" class="fa fa-laptop fa-3x mb-4"></i>
                        <h5 class="mb-3">{{__('why.staff_task')}}</h5>
                        <p class="m-0">{{__('why.staff_task_description')}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="advanced-feature-item text-center rounded py-5 px-4">
                        <i style="color: #42CD34;" class="fa fa-draw-polygon fa-3x mb-4"></i>
                        <h5 class="mb-3">{{__('why.top_notch')}}</h5>
                        <p class="m-0">{{__('why.top_notch_description')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Advanced Feature End -->


    <!-- About Start -->
    <div class="container-xxl py-6" id="about">
        <div class="container">
            <div class="row g-5 flex-column-reverse flex-lg-row">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-4">{{__('description.heading')}}</h1>
                    <p class="mb-4">{{__('description.description')}}</p>
                    <div class="d-flex mb-4">
                        <div style="background-color: #42CD34;" class="flex-shrink-0 btn-square rounded-circle text-white">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="ms-4">
                            <h5>{{__('description.heading1')}}</h5>
                            <p class="mb-0">{{__('description.description1')}}</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div style="background-color: #42CD34;" class="flex-shrink-0 btn-square rounded-circle text-white">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="ms-4">
                            <h5>{{__('description.heading2')}}</h5>
                            <p class="mb-0">{{__('description.description2')}}</p>
                        </div>
                    </div>
                    <a href="" style="background-color: #42CD34; color: #FFFFFF;" class="btn py-sm-3 px-sm-5 rounded-pill mt-3">{{__('description.read_more')}}</a>
                </div>
                <div class="col-lg-6">
                    <img class="img-fluid rounded wow zoomIn" data-wow-delay="0.5s" src="{{asset('new_landing_page/img/pc-dcs.png')}}">
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Overview Start -->
    <div class="container-xxl bg-light my-6 py-5" id="overview">
        <div class="container">
            <div class="row g-5 py-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="img-fluid rounded" src="{{asset('new_landing_page/img/dcs-app.png')}}">
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="d-flex align-items-center mb-4">
                        <h1 class="mb-0">01</h1>
                        <span style="background-color: #42CD34;" class=" mx-2" style="width: 30px; height: 2px;"></span>
                        <h5 class="mb-0">{{__('01.heading')}}</h5>
                    </div>
                    <p>{{__('01.description')}}</p>
                    <p><i style="color: #42CD34;" class="fa fa-check-circle me-3"></i>Project Management</p>
                    <p><i style="color: #42CD34;" class="fa fa-check-circle me-3"></i>{{__('01.p2')}}</p>
                    <p><i style="color: #42CD34;" class="fa fa-check-circle me-3"></i>{{__('01.p3')}}</p>
                    <p><i style="color: #42CD34;" class="fa fa-check-circle me-3"></i>{{__('01.p4')}}</p>
                    <p><i style="color: #42CD34;" class="fa fa-check-circle me-3"></i>{{__('01.p5')}}</p>
                    <p><i style="color: #42CD34;" class="fa fa-check-circle me-3"></i>{{__('01.p6')}}</p>
                </div>
            </div>
            <div class="row g-5 py-5 align-items-center flex-column-reverse flex-lg-row">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="d-flex align-items-center mb-4">
                        <h1 class="mb-0">02</h1>
                        <span style="background-color: #42CD34;" class=" mx-2" style="width: 30px; height: 2px;"></span>
                        <h5 class="mb-0">{{__('02.heading')}}</h5>
                    </div>
                    <p class="mb-4">{{__('02.description')}}</p>
                    <p><i style="color: #42CD34;" class="fa fa-check-circle me-3"></i>{{__('02.p1')}}</p>
                    <p><i style="color: #42CD34;" class="fa fa-check-circle me-3"></i>{{__('02.p2')}}</p>
                    <p><i style="color: #42CD34;" class="fa fa-check-circle me-3"></i>{{__('02.p3')}}</p>
                    <p><i style="color: #42CD34;" class="fa fa-check-circle me-3"></i>{{__('02.p4')}}</p>
                    <p><i style="color: #42CD34;" class="fa fa-check-circle me-3"></i>{{__('02.p5')}}</p>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="img-fluid rounded" src="{{asset('new_landing_page/img/dcs-custom-app.png')}}">
                </div>
            </div>
            <div class="row g-5 py-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="img-fluid rounded" src="{{asset('new_landing_page/img/dcs-software.png')}}">
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="d-flex align-items-center mb-4">
                        <h1 class="mb-0">03</h1>
                        <span style="background-color: #42CD34;" class=" mx-2" style="width: 30px; height: 2px;"></span>
                        <h5 class="mb-0">{{__('03.heading')}}</h5>
                    </div>
                    <p class="mb-4">{{__('03.description')}}</p>
                    <p><i style="color: #42CD34;" class="fa fa-check-circle me-3"></i>{{__('03.p1')}}</p>
                    <p><i style="color: #42CD34;" class="fa fa-check-circle me-3"></i>{{__('03.p2')}}</p>
                    <p><i style="color: #42CD34;" class="fa fa-check-circle me-3"></i>{{__('03.p3')}}</p>
                    <p><i style="color: #42CD34;" class="fa fa-check-circle me-3"></i>{{__('03.p4')}}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Overview End -->


    <!-- Facts Start -->
    <div style="background-color: #42CD34;" class="container-xxl my-6 py-6 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    <i class="fa fa-cogs fa-3x text-white mb-3"></i>
                    <h1 class="mb-2 text-white" data-toggle="counter-up">1000</h1>
                    <p class="text-white mb-0">{{__('info.active_install')}}</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                    <i class="fa fa-users fa-3x text-white mb-3"></i>
                    <h1 class="mb-2 text-white" data-toggle="counter-up">100</h1>
                    <p class="text-white mb-0">{{__('info.satisfied_clients')}}</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                    <i class="fa fa-certificate fa-3x text-white mb-3"></i>
                    <h1 class="mb-2 text-white" data-toggle="counter-up">5</h1>
                    <p class="text-white mb-0">{{__('info.award_wins')}}</p>
                </div>
                <div class="col-md-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                    <i class="fa fa-quote-left fa-3x text-white mb-3"></i>
                    <h1 class="mb-2 text-white" data-toggle="counter-up">10</h1>
                    <p class="text-white mb-0">{{__('info.clients_reviews')}}</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->


    <!-- Process Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="img-fluid rounded" src="{{asset('new_landing_page/img/head-image.png')}}">
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <h1 class="mb-4">{{__('description2.heading')}}</h1>
                    <p class="mb-4">{{__('description2.description')}}</p>
                    <ul class="process mb-0">
                        <li>
                            <span><i class="fa fa-cog"></i></span>
                            <div>
                                <h5>{{__('description2.heading1')}}</h5>
                                <p>{{__('description2.description1')}}</p>
                            </div>
                        </li>
                        <li>
                            <span><i class="fa fa-address-card"></i></span>
                            <div>
                                <h5>{{__('description2.heading2')}}</h5>
                                <p>{{__('description2.description2')}}</p>
                            </div>
                        </li>
                        <li>
                            <span><i class="fa fa-check"></i></span>
                            <div>
                                <h5>{{__('description2.heading3')}}</h5>
                                <p>{{__('description2.description3')}}</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Process End -->


    <!-- Pricing Start -->
    <!--div class="container-xxl py-6" id="pricing">
        <div class="container">
            <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">{{__('pricing.heading')}}</h1>
                <p class="mb-5">{{__('pricing.description')}}</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="price-item rounded overflow-hidden">
                        <div class="bg-dark p-4">
                            <h4 class="text-white mt-2">Standard</h4>
                            <div class="text-white">
                                <span class="align-top fs-4 fw-bold">$</span>
                                <h1 style="color: #42CD34;" class="d-inline display-6 mb-0"> 29.99</h1>
                                <span class="align-baseline">/ {{__('pricing.month')}}</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="d-flex justify-content-between mb-3"><span>Project Management</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.staff_management')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.floor_area')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.customer')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.report')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.cost')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.time')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.task')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <a href="" class="btn btn-dark rounded-pill py-2 px-4 mt-3">{{__('pricing.get_started')}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="price-item rounded overflow-hidden">
                        <div style="background-color: #42CD34;" class=" p-4">
                            <h4 class="text-white mt-2">{{__('pricing.professional')}}</h4>
                            <div class="text-white">
                                <span class="align-top fs-4 fw-bold">$</span>
                                <h1 class="d-inline display-6 text-dark mb-0"> 49.99</h1>
                                <span class="align-baseline">/ {{__('pricing.month')}}</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="d-flex justify-content-between mb-3"><span>Project Management</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.staff_management')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.floor_area')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.customer')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.report')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.cost')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.time')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.task')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <a style="background-color: #42CD34;"  href="" class="btn btn-success rounded-pill py-2 px-4 mt-3">{{__('pricing.get_started')}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="price-item rounded overflow-hidden">
                        <div class="bg-dark p-4">
                            <h4 class="text-white mt-2">{{__('pricing.ultimate')}}</h4>
                            <div class="text-white">
                                <span class="align-top fs-4 fw-bold">$</span>
                                <h1 style="color: #42CD34;" class="d-inline display-6 mb-0"> 79.99</h1>
                                <span class="align-baseline">/ {{__('pricing.month')}}</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="d-flex justify-content-between mb-3"><span>Project Management</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.staff_management')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.floor_area')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.customer')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.report')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.cost')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.time')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <div class="d-flex justify-content-between mb-3"><span>{{__('pricing.task')}}</span><i style="color: #42CD34;" class="fa fa-check pt-1"></i></div>
                            <a href="" class="btn btn-dark rounded-pill py-2 px-4 mt-3">{{__('pricing.get_started')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div-->
    <!-- Pricing End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-6" id="testimonial">
        <div class="container">
            <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">{{__('clients.heading2')}}</h1>
                <p class="mb-5">{{__('clients.description')}}</p>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item bg-light rounded my-4">
                    <p class="fs-5"><i style="color: #42CD34;" class="fa fa-quote-left fa-4x mt-n4 me-3"></i>{{__('clients.bella')}}</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded-circle" src="public/new_landing_page/img/testimonial-1.jpg" style="width: 65px; height: 65px;">
                        <div class="ps-4">
                            <h5 class="mb-1">Bella Jones</h5>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded my-4">
                    <p class="fs-5"><i style="color: #42CD34;" class="fa fa-quote-left fa-4x mt-n4 me-3"></i>{{__('clients.alex')}}</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded-circle" src="public/new_landing_page/img/testimonial-2.jpg" style="width: 65px; height: 65px;">
                        <div class="ps-4">
                            <h5 class="mb-1">Alex</h5>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded my-4">
                    <p class="fs-5"><i style="color: #42CD34;" class="fa fa-quote-left fa-4x mt-n4 me-3"></i>{{__('clients.jerry')}}</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded-circle" src="public/new_landing_page/img/testimonial-3.jpg" style="width: 65px; height: 65px;">
                        <div class="ps-4">
                            <h5 class="mb-1">Jerry</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Contact Start -->
    <div class="container-xxl py-6" id="contact">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-3">{{__('in_touch.heading')}}</h1>
                    <p class="mb-4">{{__('in_touch.description')}}</p>
                    <div class="d-flex mb-4">
                        <div style="background-color: #42CD34;" class="flex-shrink-0 btn-square rounded-circle text-white">
                            <i class="fa fa-phone-alt"></i>
                        </div>
                        <div class="ms-3">
                            <p class="mb-2">{{__('in_touch.call')}}</p>
                            <h5 class="mb-0">+31 6 17003075</h5>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div style="background-color: #42CD34;" class="flex-shrink-0 btn-square rounded-circle text-white">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="ms-3">
                            <p class="mb-2">{{__('in_touch.mail')}}</p>
                            <h5 class="mb-0">info@digitalcleansolution.com</h5>
                        </div>
                    </div>
                    <div class="d-flex mb-0">
                        <div style="background-color: #42CD34;" class="flex-shrink-0 btn-square rounded-circle text-white">
                            <i class="fa fa-map-marker-alt"></i>
                        </div>
                        <div class="ms-3">
                            <p class="mb-2">{{__('in_touch.office')}}</p>
                            <h5 class="mb-0">Amsterdam, Netherlands, 1101 AV</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <form  method="POST" action="{{url('/contact-us')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" required name="name" id="name" placeholder="{{__('in_touch.name')}}">
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" required name="email" id="email" placeholder="{{__('in_touch.yout_email')}}">
                                    <label for="email">Your Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" required name="subject" id="subject" placeholder="{{__('in_touch.subject')}}">
                                    <label for="subject">Subject</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" required placeholder="Leave a message here" name="message" id="message" style="height: 150px"></textarea>
                                    <label for="message">{{__('in_touch.message')}}</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button style="background-color: #42CD34; color: #FFFFFF" class="btn rounded-pill py-3 px-5" type="submit">{{__('in_touch.send_message')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-light text-body footer wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5 px-lg-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-4">
                    <p class="section-title text-black-50 h5 mb-4">{{__('footer.address')}}<span></span></p>
                    <p><i class="fa fa-map-marker-alt me-3"></i>Amsterdam, Netherlands, 1101 AV</p>
                    <p><i class="fa fa-phone-alt me-3"></i>+31 6 17003075</p>
                    <p><i class="fa fa-envelope me-3"></i>info@digitalcleansolution.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="https://twitter.com/Digitalcleansol"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/profile.php?id=100089519327654"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/digitalcleansolution/"><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-outline-light btn-social" href="https://www.linkedin.com/company/digital-clean-solution/"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <p class="section-title text-black-50 h5 mb-4">{{__('footer.link')}}<span></span></p>
                    <a class="btn btn-link" href="#home">{{__('header.home')}}</a>
                    <a class="btn btn-link" href="#features">{{__('header.features')}}</a>
                    <a class="btn btn-link" href="#pricing">{{__('header.pricing')}}</a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <p class="section-title text-black-50 h5 mb-4">{{__('footer.news')}}<span></span></p>
                    <p>{{__('footer.news_description')}}</p>
                    <div class="position-relative w-100 mt-3">
                        <input class="form-control border-0 rounded-pill w-100 ps-4 pe-5" type="text" placeholder="Your Email" style="height: 48px;">
                        <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i style="color: #42CD34;" class="fa fa-paper-plane fs-4"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container px-lg-5">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="{{url('/')}}">DCS</a>, {{__('footer.rights')}}
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
{{--                            <a href="{{url('/')}}">Home</a>--}}
{{--                            <a href="">Cookies</a>--}}
{{--                            <a href="">Help</a>--}}
{{--                            <a href="">FQAs</a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- HTML code -->
    <a href="https://api.whatsapp.com/send?phone=31617003075&text=Hello I am testing." target="_blank" class="whatsApp-wrapper">
        <div class="btn btn-lg btn-lg-square whatsApp">
            <i class="fab fa-whatsapp"></i>
        </div>
        <span class="chat-label">Chat Us</span>
    </a>
    <a href="#" style="background-color: #42CD34; color: #FFFFFF;" class="btn btn-lg btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
