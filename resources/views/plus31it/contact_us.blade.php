<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>+31-IT</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,500&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('public/css/styles.css')}}">
</head>

<body>
<!-- Topbar Section -->
<section class="bottomborder d-none d-md-block  d-sm-block  d-xs-block bg-dark">
    <div class="container">
        <div class="topbar nomarginpadding">
            <div class="row">
                <div class="col-md-9">
                    <div class="maintext maintel pt-3">
                        <p class="orangecolor pl-3"><b>Oproep voor verkooponderzoek: <a href="tel:+31652336482" class="maintel orangecolor">+31652336482</a>
                            </b></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="rightsection pt-3">
                        <div class="onhover">
                            <a href="">
                                <i class="fa fa-facebook orangecolor pr-3"></i>
                            </a>
                        </div>
                        <div class="onhover">
                            <a href="" class="orangecolor pr-3"><b>info@plus31it.com</b></a>
                        </div>
                        <div class="onhover">
                            <a href="" class="orangecolor pt-1"><b>Contact </b>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Topbar  -->
<!--Navbar Section-->
<section id="navbar" class="orangebackground py-0">
    <div class="container">
        <div class="bodystyle nomarginpadding">
            <nav class="navbar navbar-expand-lg navbar-light"> <a class="navbar-brand" href="{{url('/')}}"> <img
                        src="{{asset('public/image/logo.png')}}" height="80px" alt=""> </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item  px-2"> <a class="nav-link"
                                                       href="{{url('/')}}"><b>HOME</b> <span class="sr-only">(current)</span></a> </li>
                        <li class="nav-item px-2"> <a class="nav-link" href="{{url('/aboutus')}}"><b>OVER ONS</b></a> </li>
                        <!--							<li class="nav-item px-2"> <a class="nav-link" href="products.html"><b>PRODUCTEN</b></a></li>-->
                        <li class="nav-item px-2"> <a class="nav-link" href="{{url('/products')}}"><b> Product en Diensten</b></a> </li>
                        <li class="nav-item px-2"> <a class="nav-link" href="{{url('/working')}}"><b>WERKMETHODEN</b></a> </li>
                        <li class="nav-item active px-2"> <a class="nav-link active bordertop" href="#"><b>NEEM CONTACT OP</b></a> </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

</section>
<!--Navbar End-->

<!--jumbotron Start-->
<div class="jumbotron bg-dark orangecolor">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aboutuscontent text-center">
                    <h3 class="lightblackcolor text-uppercase"><b>Neem contact op</b></h3>
                </div>
            </div>
            <!--<div class="col-md-3">
                <div class="visiontext">
                    <ul class="visiontext">
                        <li class="pr-1">
                            <a href="#" class="darkgraycolor orangecolor">+31-IT</a>
                        </li>
                        <li>
                            /
                        </li>
                        <li class="pl-1">
                            <a href="aboutus.html" class="darkgraycolor orangecolor">Neem contact op</a>
                        </li>
                    </ul>
                </div>
            </div>-->
        </div>
    </div>
</div>
<!--jumbotoron End-->
<!--<div class="container bg-dark">
    <div class="row">
        <div class="col-md-12">
            <div class="productstext text-center">
                <h2 class="orangecolor"><b>In Contact Te Blijven</b></h2>

                <hr class="divider">

            </div>
        </div>
    </div>
</div>-->
<section class="contactsection bg-dark py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="orangecolor" for="name">Uw Naam</label>
                            <input type="name" class="form-control" id="yourname" aria-describedby="emailHelp" placeholder="Voer Naam In">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="orangecolor" for="email">Jouw email</label>
                            <input type="email" class="form-control" id="email" placeholder="Voer uw e-mailadres in">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="orangecolor" for="companyphone">Bedrijfsnaam</label>
                            <input type="email" class="form-control" id="companyphone" aria-describedby="emailHelp"
                                   placeholder="Voer de bedrijfsnaam in">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="orangecolor" for="companyname">Bedrijfstelefoon</label>
                            <input type="text" class="form-control" id="companyname"
                                   placeholder="Voer de bedrijfstelefoon in">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="orangecolor" for="city">Stad / Adres</label>
                            <input type="text" class="form-control" id="cityname" placeholder="Voer Uw Stad In
">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <textarea class="form-control" id="textarea" placeholder="Voer uw beschrijving in"></textarea>

                    </div>
                </div>

                <div class="my-2">
                    <button type="submit" class="btn btnVerzenden mt-3 orangecolor">Verzenden</button>
                </div>

            </div>
            <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2440.1885162080816!2d4.967426915269184!3d52.29443276067447!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c60c869f7db495%3A0x5c9843a593c0006!2sTefelenstraat%20103%2C%201107%20SK%20Amsterdam%2C%20Netherlands!5e0!3m2!1sen!2s!4v1602487113213!5m2!1sen!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    </div>
    <hr class="horizontal nomarginpadding">
</section>


<!--Footer-->
<footer class="footerlayout py-4 bg-dark">

    <div class="c-prefooter">

        <div class="container">

            <div class="row">

                <div class="col-md-4 col-sm-6">

                    <h5 class="orangecolor">Andere links</h5>

                    <div class="listitems">

                        <ul class="c-nav">

                            <li> <a href="{{url('/')}}">Home</a> </li>

                            <li> <a href="{{url('/products')}}">Producten</a> </li>

                        </ul>



                    </div>

                </div>

                <div class="col-md-4 col-sm-6">

                    <h5 class="orangecolor">Hulp en ondersteuning</h5>

                    <div class="listitems">

                        <ul class="c-nav">


                            <li> <a href="{{url('/contactus')}}">Neem contact op</a> </li>

                        </ul>

                    </div>

                </div>

                <div class="col-md-4">

                    <h5 class="orangecolor">Neem contact op</h5>

                    <div class="contactfooter">
                        <p class="c-about orangecolor">
                            Tefelen straat 103
                            1107sk Amsterdam Zuidoost<br />

                            <a href="mailto:info@+31-IT.com.pk">info@plus31it.com</a><br/>

                            <a href="tel:+31652336482">+31652336482</a><br/>



                        </p>
                    </div>

                </div>


            </div>

        </div>

    </div>

    <div class="c-postfooter">

        <div class="container">

            <div class="row">

                <div class="col-md-12 col-sm-6">

                    <ul class="socials" style="float:left !important;">

                        <div class="">
                            <li class="pr-3"> <a href="#" target="_blank"> <i
                                        class="fa fa-facebook facebookicon1 p-2 orangecolor"></i> </a> </li>
                        </div>

                        <li class="pt-1">

                            <p class="c-copyright c-font-oswald c-font-14 orangecolor">
                                auteursrechten &copy; +31-IT. </p>

                        </li>

                    </ul>

                    <div class="gotop float-right"> <a href="{{url('/')}}"><i class="fa fa-arrow-up"></i></a> </div>

                </div>

            </div>

        </div>

    </div>

</footer>



<!-- END FOOTER -->

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
