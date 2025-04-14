<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('public/new_landing_page/lib/wow/wow.min.js')}}"></script>
<script src="{{asset('public/new_landing_page/lib/easing/easing.min.js')}}"></script>
<script src="{{asset('public/new_landing_page/lib/waypoints/waypoints.min.js')}}"></script>
<script src="{{asset('public/new_landing_page/lib/counterup/counterup.min.js')}}"></script>
<script src="{{asset('public/new_landing_page/lib/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('public/new_landing_page/slider/js/new.js')}}"></script>
<!-- Template Javascript -->
<script src="{{asset('public/new_landing_page/js/main.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<!-- -->

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-QSGMTNLSYR"></script>

<!-- Google tag (gtag.js) --> 
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-16558461896"></script> 
<script> window.dataLayer = window.dataLayer || []; function gtag(){dataLayer.push(arguments);} gtag('js', new Date()); gtag('config', 'AW-16558461896'); </script>

<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-QSGMTNLSYR');
</script>

<script type="text/javascript">

$(document).ready(function(){
  $('#myModal').modal('show');
  var videoId=document.getElementById('myVideo');
  videoId.play();
});

$('#myModal .close').click(function() {
  console.log('Close button clicked!');
  var videoId=document.getElementById('myVideo');
  //console.log(videoId);
  videoId.pause();
  $('#myModal').modal('hide');
});


</script>
<!-- Meta Pixel Code -->
<script>
  !function(f,b,e,v,n,t,s)
  {
    if(f.fbq)return;
    n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)
  }
  (window, document,'script','https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '433550425854709');
  fbq('track', 'PageView');
</script>
<noscript>
  <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=433550425854709&ev=PageView&noscript=1"/>
</noscript>
<!-- End Meta Pixel Code -->