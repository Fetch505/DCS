<header class="masthead">
    <div class="container">
        <div class="intro-text">
            <div class="intro-lead-in"></div>
            <div class="intro-heading text-uppercase">@lang('outsideLogin.CSP')</div>
            <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">@lang('outsideLogin.TMM')</a>
        </div>
    </div>
</header>
{{--<div style="position: fixed; top: 500px; right: 5px; background-attachment: fixed; background-color: grey; float: right; z-index: 1">--}}
{{--    <div style="width: 500px;">--}}
{{--        <div class="card" style="background-color: grey">--}}
{{--            <div class="card-header">Header</div>--}}
{{--            <div class="card-body">Content</div>--}}
{{--            <div class="card-footer">Footer</div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<!-- Services -->
<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">@lang('outsideLogin.Software solutions')</h2>
                <h3 class="section-subheading text-muted">@lang('outsideLogin.ACS_Services')</h3>

            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-6">
        <span class="fa-stack fa-4x">
          <i class="fas fa-circle fa-stack-2x text-primary"></i>
          <i class="fas fa-laptop fa-stack-1x fa-inverse"></i>
        </span>
                <h4 class="service-heading">@lang('outsideLogin.web_app')</h4>
                <p class="text-muted">@lang('outsideLogin.web_app_ser')</p>
            </div>
            <div class="col-md-6">
        <span class="fa-stack fa-4x">
          <i class="fas fa-circle fa-stack-2x text-primary"></i>
          <i class="fas fa-mobile-alt fa-stack-1x fa-inverse"></i>
        </span>
                <h4 class="service-heading">@lang('outsideLogin.mob_app')</h4>
                <p class="text-muted">@lang('outsideLogin.mob_app_ser')</p>
            </div>
        <!-- <div class="col-md-4">
        <span class="fa-stack fa-4x">
          <i class="fas fa-circle fa-stack-2x text-primary"></i>
          <i class="fas fa-lock fa-stack-1x fa-inverse"></i>
        </span>
        <h4 class="service-heading">@lang('outsideLogin.ser_3')</h4>
        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima maxime quam architecto quo inventore harum ex magni, dicta impedit.</p>
      </div> -->
        </div>
    </div>
</section>

<!-- Portfolio Grid -->
<section class="bg-light" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">Portfolio</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a class="portfolio-link" data-toggle="modal" href="#portfolioModal1">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fas fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="{{ asset('public/landing_page/img/portfolio/01-thumbnail.jpg') }}" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>Threads</h4>
                    <p class="text-muted">Illustration</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a class="portfolio-link" data-toggle="modal" href="#portfolioModal2">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fas fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="{{ asset('public/landing_page/img/portfolio/02-thumbnail.jpg') }}" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>Explore</h4>
                    <p class="text-muted">Graphic Design</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a class="portfolio-link" data-toggle="modal" href="#portfolioModal3">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fas fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="{{ asset('public/landing_page/img/portfolio/03-thumbnail.jpg') }}" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>Finish</h4>
                    <p class="text-muted">Identity</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a class="portfolio-link" data-toggle="modal" href="#portfolioModal4">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fas fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="{{ asset('public/landing_page/img/portfolio/04-thumbnail.jpg') }}" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>Lines</h4>
                    <p class="text-muted">Branding</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a class="portfolio-link" data-toggle="modal" href="#portfolioModal5">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fas fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="{{ asset('public/landing_page/img/portfolio/05-thumbnail.jpg') }}" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>Southwest</h4>
                    <p class="text-muted">Website Design</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a class="portfolio-link" data-toggle="modal" href="#portfolioModal6">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fas fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="{{ asset('public/landing_page/img/portfolio/06-thumbnail.jpg') }}" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>Window</h4>
                    <p class="text-muted">Photography</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">@lang('outsideLogin.About')</h2>
                <h3 class="section-subheading text-muted">@lang('outsideLogin.ACS_About')</h3>
            </div>
        </div>
        <!--<div class="row">-->
        <!--  <div class="col-lg-12">-->
        <!--    <ul class="timeline">-->
        <!--      <li>-->
        <!--        <div class="timeline-image">-->
    <!--          <img class="rounded-circle img-fluid" src="{{ asset('/landing_page/img/about/1.jpg') }}" alt="">-->
        <!--        </div>-->
        <!--        <div class="timeline-panel">-->
        <!--          <div class="timeline-heading">-->
        <!--            <h4>2009-2011</h4>-->
        <!--            <h4 class="subheading">Our Humble Beginnings</h4>-->
        <!--          </div>-->
        <!--          <div class="timeline-body">-->
        <!--            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>-->
        <!--          </div>-->
        <!--        </div>-->
        <!--      </li>-->
        <!--      <li class="timeline-inverted">-->
        <!--        <div class="timeline-image">-->
    <!--          <img class="rounded-circle img-fluid" src="{{ asset('/landing_page/img/about/2.jpg') }}" alt="">-->
        <!--        </div>-->
        <!--        <div class="timeline-panel">-->
        <!--          <div class="timeline-heading">-->
        <!--            <h4>March 2011</h4>-->
        <!--            <h4 class="subheading">An Agency is Born</h4>-->
        <!--          </div>-->
        <!--          <div class="timeline-body">-->
        <!--            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>-->
        <!--          </div>-->
        <!--        </div>-->
        <!--      </li>-->
        <!--      <li>-->
        <!--        <div class="timeline-image">-->
    <!--          <img class="rounded-circle img-fluid" src="{{ asset('/landing_page/img/about/3.jpg') }}" alt="">-->
        <!--        </div>-->
        <!--        <div class="timeline-panel">-->
        <!--          <div class="timeline-heading">-->
        <!--            <h4>December 2012</h4>-->
        <!--            <h4 class="subheading">Transition to Full Service</h4>-->
        <!--          </div>-->
        <!--          <div class="timeline-body">-->
        <!--            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>-->
        <!--          </div>-->
        <!--        </div>-->
        <!--      </li>-->
        <!--      <li class="timeline-inverted">-->
        <!--        <div class="timeline-image">-->
    <!--          <img class="rounded-circle img-fluid" src="{{ asset('/landing_page/img/about/4.jpg') }}" alt="">-->
        <!--        </div>-->
        <!--        <div class="timeline-panel">-->
        <!--          <div class="timeline-heading">-->
        <!--            <h4>July 2014</h4>-->
        <!--            <h4 class="subheading">Phase Two Expansion</h4>-->
        <!--          </div>-->
        <!--          <div class="timeline-body">-->
        <!--            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt ut voluptatum eius sapiente, totam reiciendis temporibus qui quibusdam, recusandae sit vero unde, sed, incidunt et ea quo dolore laudantium consectetur!</p>-->
        <!--          </div>-->
        <!--        </div>-->
        <!--      </li>-->
        <!--      <li class="timeline-inverted">-->
        <!--        <div class="timeline-image">-->
        <!--          <h4>Be Part-->
        <!--            <br>Of Our-->
        <!--            <br>Story!</h4>-->
        <!--        </div>-->
        <!--      </li>-->
        <!--    </ul>-->
        <!--  </div>-->
        <!--</div>-->
    </div>
</section>
<!--
<!-- Team -->
<section class="bg-light" id="prices">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">@lang('outsideLogin.Price')</h2>
                <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                    <tr>
                        <th style="background-color:#b7b794">Plan A</th>
                        <th style="background-color:#b7b794">Plan B</th>
                        <th style="background-color:#b7b794">Plan C</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>@lang('outsideLogin.Calculation')</td>
                        <td>@lang('outsideLogin.Calculation')</td>
                        <td>@lang('outsideLogin.Discuss in a personal conversation')</td>
                    </tr>
                    <tr>
                        <td>@lang('outsideLogin.Work program')</td>
                        <td>@lang('outsideLogin.Work program')</td>
                        <td>@lang('outsideLogin.we like your needs and how our')</td>
                    </tr>
                    <tr>
                        <td>@lang('outsideLogin.Inspection')</td>
                        <td>@lang('outsideLogin.Inspection')</td>
                        <td>@lang('outsideLogin.technique can help you with this')</td>
                    </tr>
                    <tr>
                        <td>@lang('outsideLogin.Holiday request and replacement')</td>
                        <td>@lang('outsideLogin.Holiday request and replacement')</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>@lang('outsideLogin.Sick and better report')</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>12,5/@lang('outsideLogin.month')</td>
                        <td>9,50/@lang('outsideLogin.month')</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</section>

<section class="bg-light" id="price">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">
                    Choose Your App
                    {{--                    @lang('outsideLogin.Price')--}}
                </h2>
                <!-- <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3> -->
            </div>
        </div>

        {{--            <form action="/action_page.php">--}}

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    @foreach($module as $mod)
                        <div id="count" class="col-md-6"  style="margin-top: 8px; ">
                            <div class="card">
                                <div class="card-body" style="margin: 0 auto;">{{$mod->module_name}}</div>
                                <div class="" style="margin: 0 auto; padding: 0 0 15px 0">
                                    <div class="custom-control custom-switch">
                                        <input  type="checkbox" class="custom-control-input checktest" onchange="getWorkerData('yes{{$mod->id}}','{{$mod->module_discount}}','{{$mod->monthly_price}}','{{$mod->monthly_discount}}','{{$mod->module_name}}')"   value="{{$mod->yearly_price}}" id="yes{{$mod->id}}" name="{{$mod->module_name}}">
                                        <label  class="custom-control-label" for="yes{{$mod->id}}"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($loop->iteration % 2 == 0)
                </div>
                <div class="row">
                    @endif
                    @endforeach
                </div>
            </div>

            <div class="col-md-6" style="margin-top: 8px; ">

                <button class="btn" id="year" style="padding: 10px 80px 10px 80px; background-color:gainsboro; color: grey">Yearly</button>
                <button  id="monthlyData" class="btn monthly" style="padding: 10px 80px 10px 80px; background-color:gainsboro; color: grey">Monthly</button>

                <form id="yearly_form"  method="post" class="" style="margin-top: 20px; ">
                    @csrf

                    <input type="text"  class="form-control" required hidden name="module_name1" value="" readonly id="module_name1" style="display: inline-block; width: 100px; margin-left: 20px;   border-top: none; border-left: none; border-right: none; background-color: ghostwhite;">
                    <input type="text"  class="form-control" required hidden name="type_yearly1" value="yearly" id="type_yearly1" readonly  style="display: inline-block; width: 100px; margin-left: 20px;   border-top: none; border-left: none; border-right: none; background-color: ghostwhite;">

                    <div class="form-group row">
                        <label for="inputEmail3" style="margin-left: 5px;" class="col-sm-6 col-form-label">Module:</label>
                        <div class="col-sm-4">
                            <input type="number"  class="form-control text-center" readonly id="t_n"  name="total_amount1" value="" style="  border-top: none; border-left: none; border-right: none; background-color: ghostwhite;">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" style="margin-left: 5px;" class="col-sm-6 col-form-label">Count:</label>
                        <div class="col-sm-4">
                            <input type="number"  class="form-control text-center" readonly id="c_n"  name="module_count1" value="" style="  padding: 0px;  border-top: none; border-left: none; border-right: none; background-color: ghostwhite;">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" style="margin-left: 5px;" class="col-sm-6 col-form-label">You save:</label>
                        <div class="col-sm-4">
                            <input type="number"  class="form-control text-center"  name="save1" value="" readonly id="save" style="display: inline-block;     border-top: none; border-left: none; border-right: none; background-color: ghostwhite;">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" style="margin-left: 5px;" class="col-sm-6 col-form-label">Subtotal/Subscriptions:</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control text-center" name="sub_total1" value="" readonly id="sub_total" style="display: inline-block;    border-top: none; border-left: none; border-right: none; background-color: ghostwhite;">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" style="margin-left: 5px;" class="col-sm-6 col-form-label">Total(€):</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control text-center" name="total1" value="" readonly id="total_discounted_ammount" style="display: inline-block;     border-top: none; border-left: none; border-right: none; background-color: ghostwhite;">
                        </div>
                    </div>

                    <div class="form-group" style="margin: 45px auto;">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <button type="submit"  class="btn btn-success yearly-save-data"  style=" margin-left: 110px;padding: 10px 90px 10px 90px;">Free trial</button>
                        @else
                            <button type="submit" onclick="openNav()" class="btn btn-success  yearly-save-data"  style=" margin-left: 110px;padding: 10px 90px 10px 90px;">Free trial</button>
                        @endif
                    </div>
                </form>

                <form  style="display: none; margin-top: 20px;" id="monthly_form"  class=""  method="post">
                    @csrf
                    <input type="text"  class="form-control text-center" required hidden name="module_name" value="{{old('module_name')}}" readonly id="module_name" style="display: inline-block; width: 100px;   border-top: none; border-left: none; border-right: none; background-color: ghostwhite;">
                    <input type="text"  class="form-control" required hidden name="type_monthly" value="monthly" id="type_monthly" readonly style="display: inline-block; width: 100px; margin-left: 20px;   border-top: none; border-left: none; border-right: none; background-color: ghostwhite;">
                    <input type="text"  class="form-control" required hidden name="monthly_value" value="" id="monthly_value" readonly style="display: inline-block; width: 100px; margin-left: 20px;   border-top: none; border-left: none; border-right: none; background-color: ghostwhite;">

                    <div class="form-group row">
                        <label for="inputEmail3" style="margin-left: 5px;" class="col-sm-6 col-form-label">Module:</label>
                        <div class="col-sm-4">
                            <input type="number"  class="form-control text-center" name="total_amount" readonly id="tt_n" style="display: inline-block;   border-top: none; border-left: none; border-right: none; background-color: ghostwhite;">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" style="margin-left: 5px;" class="col-sm-6 col-form-label">Count:</label>
                        <div class="col-sm-4">
                            <input type="number"  class="form-control text-center"    name="module_count" value="{{old('module_count')}}" readonly id="cc_n" style="display: inline-block;  padding: 0px;  border-top: none; border-left: none; border-right: none; background-color: ghostwhite;">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" style="margin-left: 5px;" class="col-sm-6 col-form-label">You save:</label>
                        <div class="col-sm-4">
                            <input type="number"  class="form-control text-center" name="save" readonly id="ssave" style="display: inline-block;    border-top: none; border-left: none; border-right: none; background-color: ghostwhite;">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" style="margin-left: 5px;" class="col-sm-6 col-form-label">Subtotal/Subscriptions:</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control text-center" name="sub_total" readonly id="ssub_total" style="display: inline-block;   border-top: none; border-left: none; border-right: none; background-color: ghostwhite;">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputPassword3" style="margin-left: 5px;" class="col-sm-6 col-form-label">Total(€):</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control text-center" name="total" readonly id="ttotal_discounted_ammount" style="display: inline-block;    border-top: none; border-left: none; border-right: none; background-color: ghostwhite;">
                        </div>
                    </div>

                    <div class="form-group" style="margin: 45px auto;">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <button type="submit"  class="btn btn-success monthly-save-data"  style=" margin-left: 110px;padding: 10px 90px 10px 90px;">Free trial</button>
                        @else
                            <button type="submit" onclick="openNav()" class="btn btn-success monthly-save-data"  style=" margin-left: 110px;padding: 10px 90px 10px 90px;">Free trial</button>
                        @endif
                    </div>

                </form>

            </div>
        </div>
        {{--        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>--}}

        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <button  class="btn"  style="margin-left:25px; padding: 10px 20px 10px 20px; background-color:gainsboro; color: grey" id="signup">FREE TRIAL</button>
            <button  class="btn"  style=" padding: 10px 40px 10px 40px; background-color:gainsboro; color: grey" id="login">LOGIN IN</button>
            <br><br>

            <form  action="{{ route('login') }}" method="POST" style="margin-left: 25px; " id="login_form">
                @csrf

                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Login" style="width: 300px;" name="email" value="{{ old('email') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                @endif
                <br>

                <input id="password" type="password" style="width: 300px;"  placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                @endif
                <br>

                <button type="submit" class="btn btn-success"  style="padding: 10px 120px 10px 115px; ">Log in</button>

            </form>

            <form method="POST" action="{{ route('signup') }}" style="margin-left: 25px; display: none;" id="signup_form">
                @csrf
                <span style="margin-top: 8px; margin-left: 50px; color: grey;">14 days. No card required</span>

                <input id="name" type="text" style="width: 300px;" placeholder="Name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                @endif
                <br>

                <input id="email" type="email"  style="width: 300px;" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email">
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                @endif
                <br>

                <input id="password" type="password" style="width: 300px;" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                @endif
                <br>

                <input id="password-confirm" type="password" style="width: 300px;" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                <br>

                <button type="submit" class="btn btn-success"  style="padding: 10px 120px 10px 115px; ">Sign Up</button>

            </form>
        </div>



    </div>

</section>


<!-- Clients -->
<!-- <section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-6">
        <a href="#">
          <img class="img-fluid d-block mx-auto" src="{{ asset('/landing_page/img/logos/envato.jpg') }}" alt="">
        </a>
      </div>
      <div class="col-md-3 col-sm-6">
        <a href="#">
          <img class="img-fluid d-block mx-auto" src="{{ asset('/landing_page/img/logos/designmodo.jpg') }}" alt="">
        </a>
      </div>
      <div class="col-md-3 col-sm-6">
        <a href="#">
          <img class="img-fluid d-block mx-auto" src="{{ asset('/landing_page/img/logos/themeforest.jpg') }}" alt="">
        </a>
      </div>
      <div class="col-md-3 col-sm-6">
        <a href="#">
          <img class="img-fluid d-block mx-auto" src="{{ asset('/landing_page/img/logos/creative-market.jpg') }}" alt="">
        </a>
      </div>
    </div>
  </div>
</section> -->

<!-- Contact -->
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading text-uppercase">@lang('outsideLogin.Contact') @lang('outsideLogin.Us')</h2>
                <h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form id="contactForm" action="https://aheadcleaning.com/public/landing_page/mail/contact_me.php" method="POST" name="sentMessage" novalidate="novalidate">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" id="name" name="name" type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="email" name="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="phone" name="phone" type="tel" placeholder="Your Phone *" required="required" data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <textarea class="form-control" id="message" name="message" placeholder="Your Message *" required="required" data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 text-center">
                            <?php
                            session_start();
                            if(isset($_SESSION['Message']))
                                {
                                    echo $_SESSION['Message'];
                                    unset($_SESSION['Message']);
                                }

                            ?>
                            <div id="success"></div>
                            <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <span class="copyright">Copyright &copy; Your Website 2019</span>
            </div>
            <div class="col-md-4">
                <ul class="list-inline social-buttons">
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="list-inline quicklinks">
                    <li class="list-inline-item">
                        <a href="#">Privacy Policy</a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#">Terms of Use</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Portfolio Modals -->

<!-- Modal 1 -->
<div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2 class="text-uppercase">Project Name</h2>
                            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            <img class="img-fluid d-block mx-auto" src="{{ asset('public/landing_page/img/portfolio/01-full.jpg') }}" alt="">
                            <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                            <ul class="list-inline">
                                <li>Date: January 2017</li>
                                <li>Client: Threads</li>
                                <li>Category: Illustration</li>
                            </ul>
                            <button class="btn btn-primary" data-dismiss="modal" type="button">
                                <i class="fas fa-times"></i>
                                Close Project</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal 2 -->
<div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2 class="text-uppercase">Project Name</h2>
                            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            <img class="img-fluid d-block mx-auto" src="{{ asset('public/landing_page/img/portfolio/02-full.jpg') }}" alt="">
                            <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                            <ul class="list-inline">
                                <li>Date: January 2017</li>
                                <li>Client: Explore</li>
                                <li>Category: Graphic Design</li>
                            </ul>
                            <button class="btn btn-primary" data-dismiss="modal" type="button">
                                <i class="fas fa-times"></i>
                                Close Project</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal 3 -->
<div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2 class="text-uppercase">Project Name</h2>
                            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            <img class="img-fluid d-block mx-auto" src="{{ asset('public/landing_page/img/portfolio/03-full.jpg') }}" alt="">
                            <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                            <ul class="list-inline">
                                <li>Date: January 2017</li>
                                <li>Client: Finish</li>
                                <li>Category: Identity</li>
                            </ul>
                            <button class="btn btn-primary" data-dismiss="modal" type="button">
                                <i class="fas fa-times"></i>
                                Close Project</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal 4 -->
<div class="portfolio-modal modal fade" id="portfolioModal4" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2 class="text-uppercase">Project Name</h2>
                            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            <img class="img-fluid d-block mx-auto" src="{{ asset('public/landing_page/img/portfolio/04-full.jpg') }}" alt="04-full.jpg">
                            <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                            <ul class="list-inline">
                                <li>Date: January 2017</li>
                                <li>Client: Lines</li>
                                <li>Category: Branding</li>
                            </ul>
                            <button class="btn btn-primary" data-dismiss="modal" type="button">
                                <i class="fas fa-times"></i>
                                Close Project</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal 5 -->
<div class="portfolio-modal modal fade" id="portfolioModal5" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2 class="text-uppercase">Project Name</h2>
                            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            <img class="img-fluid d-block mx-auto" src="{{ asset('public/landing_page/img/portfolio/05-full.jpg') }}" alt="5-full.jpg">
                            <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                            <ul class="list-inline">
                                <li>Date: January 2017</li>
                                <li>Client: Southwest</li>
                                <li>Category: Website Design</li>
                            </ul>
                            <button class="btn btn-primary" data-dismiss="modal" type="button">
                                <i class="fas fa-times"></i>
                                Close Project</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal 6 -->
<div class="portfolio-modal modal fade" id="portfolioModal6" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="modal-body">
                            <!-- Project Details Go Here -->
                            <h2 class="text-uppercase">Project Name</h2>
                            <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                            <img class="img-fluid d-block mx-auto" src="{{ asset('public/landing_page/img/portfolio/06-full.jpg') }}" alt="">
                            <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                            <ul class="list-inline">
                                <li>Date: January 2017</li>
                                <li>Client: Window</li>
                                <li>Category: Photography</li>
                            </ul>
                            <button class="btn btn-primary" data-dismiss="modal" type="button">
                                <i class="fas fa-times"></i>
                                Close Project</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
{{--                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>--}}
                <button type="button" class="close" onclick="myVideo()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
{{--            <div class="modal-body">--}}
                <video id="myVideo" width="470" height="440" style="margin-left: 10px" autoplay controls >
                    <source src="{{asset('public/images/Ahead Cleaning Mobile App Dutch (3).mp4')}}" type="video/mp4">
{{--                    <source src="movie.ogg" type="video/ogg">--}}
                </video>
{{--            </div>--}}
            <div class="modal-footer">
{{--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
{{--                <button type="button" class="btn btn-primary">Save changes</button>--}}
            </div>
        </div>
    </div>
</div>

{{--<script src="{{asset('/js/vue.min.js')}}"></script>--}}

{{--<script src="{{ asset('/js/axios.min.js') }}"></script>--}}

