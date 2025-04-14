<script src="{{asset('landing_page/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('landing_page/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Plugin JavaScript -->
<script src="{{asset('landing_page/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Contact form JavaScript -->
<script src="{{asset('landing_page/js/jqBootstrapValidation.js')}}"></script>
{{--<script src="{{asset('landing_page/js/contact_me.js')}}"></script>--}}

<!-- Custom scripts for this template -->
<script src="{{asset('landing_page/js/agency.min.js')}}"></script>
<script src="{{asset('landing_page/js/agency.js')}}"></script>

<!-- welcome old scripts-->
<!-- <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script> -->
<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{asset('js/modulePrice.js')}}"></script>

<script src="{{ asset('js/languageSwitcher.js') }}"></script>
<!-- -->
<script type="text/javascript">
	  $(window).on('load', function() {
        $('#myModal').modal('show');
         var videoId=document.getElementById('myVideo');
         videoId.play();

    });
    function myVideo(){
         var videoId=document.getElementById('myVideo');
         videoId.pause();

    }


    </script>
