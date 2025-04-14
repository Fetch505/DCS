<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>+31-IT</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,500&display=swap" rel="stylesheet">
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
                        <!--<li class="nav-item  px-2"> <a class="nav-link" href="products.html"><b>PRODUCTEN</b></a></li>-->
                        <li class="nav-item active px-2"> <a class="nav-link active bordertop" href="#"><b> Product en Diensten</b></a> </li>
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

<!--Main Header End-->

<!--jumbotron Start-->
<div class="jumbotron bg-dark orangecolor">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="aboutuscontent text-center">
                    <h3 class="lightblackcolor"><b> Product en Diensten</b></h3>
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
                            <a href="services.html" class="darkgraycolor orangecolor text-lowercase">PRODUCT & DIENSTEN</a>
                        </li>
                    </ul>
                </div>
            </div>-->
        </div>
    </div>
</div>
<!--jumbotoron End-->

<!--services area-->
<section class="servicesarea bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="servicecontainer">
                    <a href="">
                        <div class="serviceimage text-center orangecolor">
                            <img src="{{asset('public/image/setting.svg')}}" class="mb-3 orangecolor py-5" height="150px" alt="">
                            <h3><b>Maatwerk</b></h3>
                        </div>
                    </a>
                </div>
                <div class="servicestext text-justify orangecolor  py-3">
                    <p>
                        Wilt u een webapplicatie op maat laten bouwen voor specifieke bedrijfsprocessen, uitdagingen of innovatieve ideeën? Of werkt u met verschillende softwaresystemen die niet geïntegreerd zijn? Kies dan voor maatwerk webapplicaties van +31-IT.
                    </p>


                </div>

            </div>
            <div class="col-md-4">
                <div class="servicecontainer">
                    <a href="">
                        <div class="serviceimage orangecolor text-center">
                            <img src="{{asset('public/image/music-sound-bars.svg')}}" class="mb-3 py-5" height="150px" alt="">
                            <h3><b>Webportal development</b></h3>
                        </div></a>
                </div>
                <div class="servicestext text-justify orangecolor  py-3">
                    Inzichtelijker. Efficiënter. Minder arbeidsintensief. Dat is het effect van slimme webportalen op uw bedrijfsprocessen. Samenwerken, ook met klanten en leveranciers, wordt er eenvoudiger van. Van informatie verzamelen en delen, tot bestellen en betalen – een webapplicatie is er de aangewezen oplossing voor.

                    We hebben alle expertise in huis om een maatwerkoplossing voor u te realiseren. Zelfs het koppelen aan bestaande systemen is geen enkel probleem. En is uw webapplicatie ook perfect toegankelijk via een tablet of smartphone. Zo makkelijk kan het zijn!
                </div>
            </div>
            <div class="col-md-4">
                <div class="servicecontainer">
                    <a href="#">
                        <div class="serviceimage orangecolor text-center">
                            <img src="{{asset('public/image/link.svg')}}" class="mb-3 darkcolor py-5" height="150px" alt="">
                            <h3><b>API Koppelingen</b></h3>
                        </div></a>
                </div>
                <div class="servicestext orangecolor text-justify py-3">
                    Wanneer een een webapplicatie wordt gekoppeld aan bestaande systemen binnen uw organisatie en die van klanten en leveranciers, neemt de kracht van deze oplossing alleen maar toe. Het uitwisselen van gegevens verloopt daarmee namelijk aanzienlijk makkelijker, sneller en goedkoper.

                    Het bouwen van een duurzame koppeling is specialistisch werk en vergt vergaande technische kennis. Er zijn namelijk vaak meerdere mogelijkheden om systemen met elkaar te integreren.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="servicecontainer">
                    <a href="">
                        <div class="serviceimage text-center orangecolor">
                            <img src="{{asset('public/image/mobileappicon.svg')}}" class="mb-3 orangecolor py-5" height="170px" alt="">
                            <h3><b>Ontwikkeling van mobiele applicaties</b></h3>
                        </div>
                    </a>
                </div>
                <div class="servicestext orangecolor text-justify  py-3">
                    Wij ontwikkelen enterprise apps gecombineerd met een uitstekend ontwerp. Gebouwd met de nieuwste geavanceerde technologieën en mogelijkheden. Maar verliezen nooit betrouwbare en beproefde methoden uit het oog. We stellen vragen en nemen niets voor lief. We verleggen grenzen, samen. Om te komen tot jouw mobiele oplossing met het allerbeste resultaat.
                    Succesvol. Betrouwbaar. Schaalbaar.
                </div>
            </div>
            <!--<div class="col-md-4">
                <div class="servicecontainer">
                   <a href="">
                    <div class="serviceimage orangecolor text-center">
                       <img src="images/link.svg" class="mb-3 darkcolor py-5" height="150px" alt="">
                       <h3><b>Uitbesteding</b></h3> <br>
                   </div></a>
               </div>
                <div class="servicestext text-justify orangecolor  py-3">
                  Inzichtelijker. Efficiënter. Minder arbeidsintensief. Dat is het effect van slimme webportalen op uw bedrijfsprocessen. Samenwerken, ook met klanten en leveranciers, wordt er eenvoudiger van. Van informatie verzamelen en delen, tot bestellen en betalen – een webapplicatie is er de aangewezen oplossing voor.

  We hebben alle expertise in huis om een maatwerkoplossing voor u te realiseren. Zelfs het koppelen aan bestaande systemen is geen enkel probleem. En is uw webapplicatie ook perfect toegankelijk via een tablet of smartphone. Zo makkelijk kan het zijn!
                </div>
            </div> -->

        </div>
    </div>
</section>
<hr class="horizontal nomarginpadding">
<!--End Services Area-->

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





<!--Footer End-->







<!--Footer End-->


<!--Clients Carousel-->

<script>
    function myFunction() {
        var dots = document.getElementById("dots");
        var moreText = document.getElementById("more");
        var btnText = document.getElementById("myBtn");

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "Read less";
            moreText.style.display = "inline";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "Read more";
            moreText.style.display = "none";

        }
    }
</script>

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
