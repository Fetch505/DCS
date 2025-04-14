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
                        <!--<li class="nav-item px-2"> <a class="nav-link" href="products.html"><b>PRODUCTEN</b></a></li>-->
                        <li class="nav-item px-2"> <a class="nav-link" href="{{url('/products')}}"><b> Product en Diensten</b></a> </li>
                        <li class="nav-item active px-2"> <a class="nav-link active bordertop" href="#"><b>WERKMETHODEN</b></a> </li>
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
                    <h3 class="lightblackcolor"><b>Werkwijze</b></h3>
                </div>
            </div>
            <!--<div class="col-md-2">
                <div class="visiontext">
                    <ul class="visiontext">
                     <li class="pr-1">
                         <a href="#" class="darkgraycolor orangecolor">+31-IT</a>
                     </li>
                        <li>
                            /
                        </li>
                        <li class="pl-1">
                            <a href="services.html" class="darkgraycolor orangecolor">Werkwijze</a>
                        </li>
                    </ul>
                </div>
            </div>-->
        </div>
    </div>
</div>
<!--jumbotoron End-->

<!--textarea-->
<section class="textarea bg-dark pt-2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="textarea orangecolor">
                    <p>
                        Digitale transformatie biedt unieke kansen om beter te presteren en succesvol te groeien. Eigenlijk is iedere onderneming tegenwoordig een technologiebedrijf. Alleen heeft niet iedereen de expertise in huis om die technologie zelf te ontwikkelen. Wij helpen u om optimaal gebruik te maken van digitalisering. Dit is hoe we dat doen.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>
<!--textarea-->
<!--imagesarea-->
<section class="imagessection bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contentsection1 orangecolor py-5">
                    <h3>Oriëntatie</h3>
                    <p>Welk probleem wilt u oplossen? Wanneer u digitalisering wilt inzetten om de processen en prestaties van uw organisatie te verbeteren, gaan onze business engineers aan de slag met een GAP-analyse. Binnen 4 weken brengen we met process flows in kaart hoe u nu werkt, wat uw bedrijfsdoelstellingen zijn en op welke manier digitalisering u helpt om deze te verwezenlijken. <br> Over technische zaken hebben we het zo min mogelijk, het gaat erom dat we elkaar goed leren kennen en begrijpen. Na afloop ontvangt u een uitgewerkt document dat kan dienen als basis voor de volgende stap: de business analyse. Deze oriëntatie is kosteloos en verplicht u tot niets. <br>Heeft u zelf al uitgewerkte ideeën over een online toepassing, dan gaan we in een requirements workshop aan de slag om uw wensen zo scherp en gedetailleerd mogelijk boven tafel te krijgen. Het resultaat wordt gepresenteerd in een transparante roadmap en begroting. Daardoor weet u precies wat u mag verwachten en op welk tijdstip.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="imagesection pt-5">
                    <div class="text-center">
                        <img src="{{asset('public/image/hr.jpg')}}" class="img-responsive" height="400px;" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-5">

            <div class="col-md-6">
                <div class="imagesection">
                    <div class="">
                        <img src="{{asset('public/image/hr.jpg')}}" class="img-responsive" height="400px;" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contentsection2 orangecolor py-5">
                    <h3>Business Analyse</h3>
                    <p>
                        Wanneer u digitalisering wilt inzetten om de processen en prestaties van uw organisatie te verbeteren, gaan onze business engineers aan de slag met een GAP-analyse. Binnen 4 weken brengen we met process flows in kaart hoe u nu werkt, wat uw bedrijfsdoelstellingen zijn en op welke manier digitalisering u helpt om deze te verwezenlijken. Heeft u zelf al uitgewerkte ideeën over een online toepassing, dan gaan we in een requirements workshop aan de slag om uw wensen zo scherp en gedetailleerd mogelijk boven tafel te krijgen. Het resultaat wordt gepresenteerd in een transparante roadmap en begroting. Daardoor weet u precies wat u mag verwachten en op welk tijdstip. <br>
                        “Uw business echt verder helpen met slimme IT-oplossingen, dat is onze ambitie. We willen er samen een succes van maken.”</p>
                </div>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-6">
                <div class="contentsection3 orangecolor py-5">
                    <h3>Realisatie</h3>
                    <p>In een aantal korte, overzichtelijke ‘sprints’ werken we, samen met u, aan het eindresultaat. Deze scrum werkwijze voorkomt fouten, bespaart geld en zorgt voor een kortere time-to-market. Bovendien kunnen we ons flexibel aanpassen als omstandigheden en eisen tijdens het project veranderen. <br>
                        U wordt regelmatig door het team betrokken voor het maken van de juiste keuzes. Zo blijven business doelstellingen, gebruikerservaringen en technologie in lijn. <br>
                        Kwaliteit, betrouwbaarheid en veiligheid staan bij ons voorop. We gebruiken state-of-the-art tools en methodieken en werken volgens de strengste normen   en standaarden. Software is tenslotte ook voor uw organisatie van bedrijf kritische betekenis en daar zijn we ons terdege van bewust.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="imagesection">
                    <div class="text-center">
                        <img src="{{asset('public/image/hr.jpg')}}" class="img-responsive" height="400px;" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-5">

            <div class="col-md-6">
                <div class="imagesection">
                    <div class="">
                        <img src="{{asset('public/image/hr.jpg')}}" class="img-responsive" height="400px;" alt="">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contentsection4 orangecolor py-5">
                    <h3>Beheer</h3>
                    <p>Wanneer uw onlineapplicatie of web portaal live is, begint het echte werk pas. U gaat volop gebruik maken van digitalisering om uw bedrijfsdoelstellingen te behalen. Continuïteit en veiligheid zijn daarbij van cruciaal belang. Klanten, medewerkers en leveranciers moeten erop kunnen vertrouwen dat alles correct werkt. <br>
                        Als ondernemend partner doet +31-IT er alles aan om de kwaliteit van uw applicatie blijvend te waarborgen. Met Applicatiemanagement kiest u voor maximale zekerheid voor een vast bedrag per jaar. U verzekert zich van nieuwe updates, het functioneren van uw applicatie wordt 24/7 gemonitord en we staan altijd klaar om problemen snel op te lossen.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="contentsection3 orangecolor py-5">
                    <h3>Doorontwikkeling</h3>
                    <p>
                        De markt verandert continu, klanten hebben steeds hogere eisen en verwachtingen en de concurrentie zit uiteraard ook niet stil. Daarnaast blijven de technologische vernieuwingen elkaar in hoog tempo opvolgen. Daarom houden we contact met u. Bent u nog tevreden over de resultaten? Of wordt het tijd voor een nieuwe business analyse, nieuwe doelstellingen en nieuwe of verbeterde oplossingen? Er is tenslotte altijd een next level…
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="imagesection">
                    <div class="text-center">
                        <img src="{{asset('public/image/hr.jpg')}}" class="img-responsive" height="400px;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="horizontal nomarginpadding mt-3">
</section>

<!--imagesarea-->
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
                                        class="fa fa-facebook facebookicon1 orangecolor p-2"></i> </a> </li>
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
