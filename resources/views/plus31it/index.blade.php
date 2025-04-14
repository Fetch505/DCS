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
                            <a href="mailto:info@fireupit.com" class="orangecolor pr-3"><b>info@plus31it.com</b></a>
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
            <nav class="navbar navbar-expand-lg navbar-light"> <a class="navbar-brand"href="{{url('/')}}"> <img
                        src="{{asset('public/image/logo.png')}}" height="80px" alt=""> </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active px-2"> <a class="nav-link active bordertop"
                                                             href="index.html"><b>HOME</b> <span class="sr-only">(current)</span></a> </li>
                        <li class="nav-item px-2"> <a class="nav-link" href="{{url('/aboutus')}}"><b>OVER ONS</b></a> </li>
                        <!--<li class="nav-item px-2"> <a class="nav-link" href="products.html"><b>PRODUCTEN</b></a></li>-->
                        <li class="nav-item px-2"> <a class="nav-link" href="{{url('/products')}}"><b>Product en Diensten</b></a> </li>
                        <li class="nav-item px-2"> <a class="nav-link" href="{{url('/working')}}"><b>WERKMETHODEN</b></a> </li>
                        <li class="nav-item px-2"> <a class="nav-link" href="{{url('/contactus')}}"><b>NEEM CONTACT OP</b></a> </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

</section>
<!--Navbar End-->
<!--Main Header-->

<div class="bannerimage d-block d-sm-none">


    <!--<img src="images/mobile-banner.jpg" alt="">-->

</div>
<section class="mainheader d-none  d-md-block  d-sm-block  d-xs-block">

    <div id="demo" class="carousel slide" data-ride="carousel">

        <!-- The slideshow -->
        <div class="carousel-inner">
            <!-- <div class="carousel-item active header">
                <div class="row text-center">

                    <div class="col-md-1">
                    </div>
                    <div class="col-md-8">
                        <div class="text-center text-center" data-transition="fade" data-slotamount="1"
                            data-masterspeed="1000">
                            <div class="erpcontent">
                                <h1 class="whitecolor text-uppercase">Nederland <span class="mainbluedcolor">BESTE ERP</span>
                                    OPLOSSING</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">

                            </div>
                            <div class="col-md-3">
                                <div class="listtext  pt-5">
                                    <p class="whitecolor">Productie</p>
                                    <p class="whitecolor">Voorraadketenbeheer</p>
                                    <p class="whitecolor">Financiëne</p>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="listtext  pt-5">
                                    <p class="whitecolor">Project management</p>
                                    <p class="whitecolor"> Personeelszaken</p>
                                    <p class="whitecolor">Beheer van klantrelaties</p>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="listtext  pt-5">
                                    <p class="whitecolor">Datawarehouse</p>
                                    <p class="whitecolor">Toegangscontrole</p>
                                    <p class="whitecolor">Maatwerk</p>

                                </div>
                            </div>
                            <div class="col-md-1">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="explore pt-3">
                                    <a href="#" class="btn whitecolor explorebtn">Verken</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                        </div>

                    </div>





                </div>
            </div>
            <div class="carousel-item header1">
                <div class="row text-center">

                    <div class="col-md-4">
                    </div>
                    <div class="col-md-7">
                        <div class="text-center text-center" data-transition="fade" data-slotamount="1"
                            data-masterspeed="1000">
                            <div class="erpcontent">
                                <h1 class="">PUNT VAN VERKOOP OPLOSSING</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">

                            </div>
                            <div class="col-md-3">
                                <div class="listtext  pt-5">
                                    <p class="">Inventry Module</p>
                                    <p class="">Aankoopmodule</p>
                                    <p class="">Accountsrapport</p>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="listtext  pt-5">
                                    <p class="">Boekhoudmodule</p>
                                    <p class=""> Verkoopmodule</p>
                                    <p class="">Voorraadrapporten</p>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="listtext  pt-5">
                                    <p class="">Verkooprapporten</p>
                                    <p class="">Aankooprapporten</p>


                                </div>
                            </div>
                            <div class="col-md-1">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="explore pt-3">
                                    <a href="#" class="btn mainredcolor explorebtn1">Verken</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                        </div>

                    </div>





                </div>
            </div> -->
            <div class="carousel-item active header2">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="text-center text-center" data-transition="fade" data-slotamount="1"
                             data-masterspeed="1000">
                            <div class="erpcontent orangecolor">
                                <h3 class="">Ontwikkeling van mobiele apps</h3>
                            </div>
                        </div>
                        <div class="row pl-4">

                            <div class="col-md-6">
                                <div class="listtext orangecolor  pt-5">
                                    <p class="">iOS-app</p>
                                    <p class="">Android-app</p>
                                    <p class="">Windows Mobile-app</p>


                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="listtext  pt-5">
                                    <p class="">Aangepaste mobiele applicatie</p>
                                    <p class="">Ondersteuning voor mobiele apps</p>
                                    <p class="">iPad-applicatie</p>
                                    <p class="">iPod-applicatie</p>

                                </div>
                            </div> -->


                        </div>
                    </div>
                    <div class="col-md-4">


                    </div>
                    <div class="col-md-4">
                        <div class="text-center text-center" data-transition="fade" data-slotamount="1"
                             data-masterspeed="1000">
                            <div class="erpcontent orangecolor">
                                <h3 class="">Webontwerp en -ontwikkeling</h3>
                            </div>
                        </div>
                        <div class="row pl-3">

                            <div class="col-md-6">
                                <div class="listtext orangecolor pt-5">
                                    <p class="">E-commerce</p>
                                    <p class="">Magento</p>
                                    <p class="">Wordpress</p>
                                    <p class="">Laravel</p>
                                    <p class=""> Codeigniterr</p>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="listtext orangecolor pt-5">
                                    <p class="">Project Managemen</p>
                                    <p class=""> Human Resources</p>
                                    <p class="">Financials</p>

                                </div>
                            </div>


                        </div>
                        <!-- <div class="row">
                            <div class="col-md-12">
                                <div class="explore pt-3">
                                    <a href="#" class="btn mainredcolor explorebtn1">Verken</a>
                                </div>
                            </div>
                        </div> -->
                    </div>





                </div>
            </div>
        </div>

        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>


</section>
<!--Main Header End-->

<!--products Section-->
<section class="products pt-5 bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="productstext orangecolor text-center">
                    <h2><b>Diensten</b></h2>
                    <!-- divider-->
                    <hr class="divider">
                    <!--divider-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="http://plus31it.com/">
                    <!--Enterprise Section Start-->
                    <div class="iconcontainer py-4">
                        <div class="iconwrapper">
                            <a href="http://plus31it.com/">
                                <img src="{{asset('public/image/web.svg')}}" class="icon pr-2" height="60px;" alt=""></a>
                        </div>

                        <div class="containertext pl-4">
                            <a href="https://fireupit.com/">
                                <h5 class="orangecolor">Webapplicaties op maat</h5>
                                <p class="orangecolor">Wilt u een webapplicatie op maat laten bouwen voor specifieke
                                    bedrijfsprocessen, uitdagingen of innovatieve ideeën? Of werkt u met
                                    verschillende softwaresystemen die niet geïntegreerd zijn? Kies dan voor
                                    maatwerk webapplicaties van +31-IT.

                                    Wij zijn zowel technisch bedrijfskundig onderlegd als gespecialiseerd in het
                                    ontwikkelen van online ICT-oplossingen. ...</p>
                            </a>
                        </div>


                    </div>
                </a>
            </div>

            <!--Hospital Management-->
            <div class="col-md-6">
                <a href="productandservices.html">
                    <!--Enterprise Section Start-->
                    <div class="iconcontainer py-4">
                        <div class="iconwrapper">
                            <a href="productandservices.html"><img src="{{asset('public/image/web-development.svg')}}" class="icon pr-2" height="60px;" alt=""></a>
                        </div>

                        <div class="containertext pl-4">
                            <a href="productandservices.html">
                                <h5 class="orangecolor">Webportal development</h5>
                                <p class="orangecolor">Inzichtelijker. Efficiënter. Minder arbeidsintensief. Dat is
                                    het effect van slimme webportalen op uw bedrijfsprocessen. Samenwerken, ook met
                                    klanten en leveranciers, wordt er eenvoudiger van. Van informatie verzamelen en
                                    delen, tot bestellen en betalen – een webapplicatie is er de aangewezen
                                    oplossing voor.

                                    We hebben alle expertise in huis om een maatwerkoplossing voor u te realiseren.
                                    Zelfs het koppelen aan bestaande systemen is geen enkel probleem. En is uw
                                    webapplicatie ook perfect toegankelijk via een tablet of smartphone. Zo
                                    makkelijk kan het zijn!</p>
                            </a>
                        </div>


                    </div>
                </a>
            </div>


            <!--End Hospital Management-->
        </div>
        <div class="row">
            <!--API Koppelingen-->
            <div class="col-md-6">
                <a href="productandservices.html">
                    <!--Enterprise Section Start-->
                    <div class="iconcontainer py-4">
                        <div class="iconwrapper">
                            <a href="productandservices.html"><img src="{{asset('public/image/api.svg')}}" class="icon pr-2" height="60px;" alt=""></a>
                        </div>

                        <div class="containertext pl-4">
                            <a href="productandservices.html">
                                <h5 class="orangecolor">API Koppelingen</h5>
                                <p class="orangecolor">Wanneer een een webapplicatie wordt gekoppeld aan bestaande
                                    systemen binnen uw organisatie en die van klanten en leveranciers, neemt de
                                    kracht van deze oplossing alleen maar toe. Het uitwisselen van gegevens verloopt
                                    daarmee namelijk aanzienlijk makkelijker, sneller en goedkoper.

                                    Het bouwen van een duurzame koppeling is specialistisch werk en vergt vergaande
                                    technische kennis. Er zijn namelijk vaak meerdere mogelijkheden om systemen met
                                    elkaar te integreren.</p>
                            </a>
                        </div>


                    </div>
                </a>
            </div>
            <!--End Hr-->
            <!--API Koppelingen-->
            <div class="col-md-6">
                <a href="productandservices.html">
                    <!--Enterprise Section Start-->
                    <div class="iconcontainer py-4">
                        <div class="iconwrapper">
                            <a href="productandservices.html"><img src="{{asset('public/image/mobile-app.svg')}}" class="icon pr-2" height="60px;" alt=""></a>
                        </div>

                        <div class="containertext pl-4">
                            <a href="productandservices.html">
                                <h5 class="orangecolor">Mobiele ontwikkeling</h5>
                                <p class="orangecolor">Wanneer een een webapplicatie wordt gekoppeld aan bestaande
                                    systemen binnen uw organisatie en die van klanten en leveranciers, neemt de
                                    kracht van deze oplossing alleen maar toe. Het uitwisselen van gegevens verloopt
                                    daarmee namelijk aanzienlijk makkelijker, sneller en goedkoper.

                                    Het bouwen van een duurzame koppeling is specialistisch werk en vergt vergaande
                                    technische kennis. Er zijn namelijk vaak meerdere mogelijkheden om systemen met
                                    elkaar te integreren.</p>
                            </a>
                        </div>


                    </div>
                </a>
            </div>
            <!--End Hr-->
        </div>



    </div>
    </div>
</section>


<!--Products Section End-->



<!-- Clients Section-->
<section cite="clients pt-3 verticalmargin">
    <div class="clientsbackground nomarginpadding bg-dark">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="Clienttext pt-3 text-center">
                        <h2 class="orangecolor"><b>ONZE PRODUCTEN</b></h2>

                    </div>
                </div>
            </div>
            <div class="row px-5">
                <div class="col-md-12">

                    <div id="blogCarousel" class="carousel slide" data-ride="carousel">

                        <!-- <ol class="carousel-indicators">
                        <li data-target="#blogCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#blogCarousel" data-slide-to="1"></li>
                    </ol>-->
                        <ul class="carousel-indicators">
                            <!-- <li data-target="#blogCarousel" data-slide-to="0" class="active"></li> -->
                            <!-- <li data-target="#blogCarousel" data-slide-to="1"></li> -->
                        </ul>

                        <!-- Carousel items -->
                        <div class="carousel-inner">

                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-md-4 mb-2">

                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <a href="{{url('/acs')}}">
                                            <img src="{{asset('public/image/client-10.jpg')}}" alt="Image" style="max-width:100%;">
                                        </a>
                                    </div>

                                    <div class="col-md-4 mb-2">
                                        <a href="#">

                                        </a>
                                    </div>
                                </div>

                            </div>
                            <!--.item-->

                            <!--								<div class="carousel-item">-->
                            <!--									<div class="row">-->
                            <!--										<div class="col-md-4 mb-2">-->

                            <!--										</div>-->
                            <!--										<div class="col-md-4 mb-2">-->
                            <!--											<a href="#">-->
                            <!--												<img src="images/client-10.jpg" alt="Image" style="max-width:100%;">-->
                            <!--											</a>-->
                            <!--										</div>-->

                            <!--										<div class="col-md-4 mb-2">-->
                            <!--											<a href="#">-->

                            <!--											</a>-->
                            <!--										</div>-->
                            <!--									</div>-->

                            <!--								</div>-->


                        </div>
                        <!--.carousel-inner-->
                    </div>
                    <!--.Carousel-->

                </div>
            </div>
        </div>
    </div>
</section>
<hr class="horizontal nomarginpadding">
<!--End Client Section-->

<!--testimonial-->
<section id="testimonial pt-5 my-5" class="bg-warning">
    <!--<div class="container my-5">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="Clienttext pt-5 text-center">
                    <h2><b>GETUIGENISSEN VAN DE KLANT</b></h2>

                    <hr class="divider">

                </div>
            </div>
        </div>-->
    <div id="demo1" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            <!-- <li data-target="#demo1" data-slide-to="0" class="active"></li>
            <li data-target="#demo1" data-slide-to="1"></li>
            <li data-target="#demo1" data-slide-to="2"></li> -->
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            <div class="carousel-item active testimonial text-center">
                <div class="innercontent">

                    <p class="">“Sinds de laatste 7 jaar dat ik met +31-IT werk, heb ik het opmerkelijk gevonden
                        verbetering <br> in infrastructuur, reikwijdte van het werk en inzet. Het team is erg
                        getalenteerd en <br> in staat om oplossingen te leveren op bijna alle gebieden. De systemen
                        geleverd door hen in <br> Shafi werken prima en hebben voor goede controles gezorgd. mei
                        ze gaan met grote sprongen <br> en grenzen. "</p>

                    <h3> <span class="c-name c-theme">Tariq Nadeem</span>, HR Manager, Shafi (Pvt.) Ltd. </h3>
                </div>

            </div>
            <div class="carousel-item testimonial text-center">
                <div class="innercontent">

                    <p>“+31-IT E-commerce-oplossing is geweldig, we werken al met hen samen voor <br>
                        afgelopen 4 jaar en hun vaardigheden staan bovenaan. " </p>
                    <h3> <span class="c-name c-theme">Umar Alvi</span>, IT Manager, Deluxe Footwear</h3>
                </div>
            </div>
            <!-- <div class="carousel-item testimonial text-center">
                <div class="innercontent">

                    <p class="">“Sinds de laatste 7 jaar dat ik met Vision Plus werk, heb ik het opmerkelijk gevonden
                        verbetering <br> in infrastructuur, reikwijdte van het werk en inzet. Het team is erg
                        getalenteerd en <br> in staat om oplossingen te leveren op bijna alle gebieden. De systemen
                        geleverd door hen in <br> Shafi werken prima en hebben voor goede controles gezorgd. mei
                        ze gaan met grote sprongen <br> en grenzen. "</p>

                    <h3> <span class="c-name c-theme">Tariq Nadeem</span>, HR Manager, Shafi (Pvt.) Ltd. </h3>
                </div>
            </div> -->
        </div>


    </div>
    </div>

</section>
<!--End Testimonial-->
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
                            <li> <a href="{{url('products')}}">Producten</a> </li>

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



<!--Clients Carousel-->
<script>
    $('#blogCarousel').carousel({
        interval: 100
    });
</script>
<!--End Clients Carousel-->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
