<!-- Navbar & Hero Start -->
<div class="container-xxl position-relative p-0" id="home">
      <nav style="background-color: #FFFFFF; " class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
        <a href="{{url('/')}}" class=" p-0">
            <img style="height: 65px; width: 160px;" src="{{asset('new_landing_page/img/final_logo_dcs.png')}}" alt="Logo">
        </a>
        <button class="navbar-toggler rounded-pill" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a style="color: #000000" href="{{url('/')}}" class="nav-item nav-link active">{{__('header.home')}}</a>
                <a style="color: #000000" href="{{route('blog')}}" class="nav-item nav-link">{{__('header.blog')}}</a>
                <a style="color: #000000" href="{{route('login')}}" class="nav-item nav-link">{{__('header.login')}}</a>
            </div>
            <p style="padding-top: 15px; color: #226829"><i class="fa fa-phone-alt me-3"></i>+31 6 17003075</p>
            <a href="https://digitalcleansolution.com/register" style="background-color: #42CD34; color: #FFFFFF;" class="btn btn-light rounded-pill py-2 px-4 ms-3">{{__('header.free_trail')}}</a>
            <div class="dropdown">
                <button style="background-color: #42CD34; color: #FFFFFF;" class="btn btn-light rounded-pill py-2 px-4 ms-3">Language</button>
                <div class="dropdown-content">
                    <a href="{{url('/change-language/en')}}" class="dropdown-item">English</a>
                    <a href="{{url('/change-language/nl')}}" class="dropdown-item">Dutch</a>
                </div>
            </div>
        </div>
      </nav>
    </div>
    <!-- Navbar & Hero End -->

@php
    use Illuminate\Support\Str;
@endphp

    <!-- Advanced Feature Start -->
    <div class="container py-6" id="features">
        <div class="container">
            <div class="mx-auto text-center wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">{{__('why.heading')}}</h1>
                <p class="mb-5">{{__('why.sub_heading')}}</p>
            </div>
        </div>
    </div>
    <!-- Advanced Feature End -->

 {{-- Blog AREA   --}}

 @php
function sluggify($url)
{
    $url=implode(' ', array_slice(explode(' ', $url), 0, 5));// 5 words

    # Prep string with some basic normalization
    $url = strtolower($url);
    $url = strip_tags($url);
    $url = stripslashes($url);
    $url = html_entity_decode($url);

    # Remove quotes (can't, etc.)
    $url = str_replace('\'', '', $url);

    # Replace non-alpha numeric with hyphens
    $match = '/[^a-z0-9]+/';
    $replace = '-';
    $url = preg_replace($match, $replace, $url);

    $url = trim($url, '-');

    return $url;
}
 @endphp

   <style>
    .blog-posts a h2, .blog-posts a p{
        color: #202942;
    }
    .blog-posts h2:hover, .blog-posts p:hover{
        color: #42568b;
    }
    h2{
        text-align: start;
        padding: 0px;
    }
   

   </style>
    @foreach($blogs as $blog)
        <!-- Blog Start -->
        <div class="container" id="about">
            <div class="container blog-posts">
                <div class="row justify-content-center align-items-center g-5 pb-3 flex-column-reverse flex-lg-row wow fadeInUp" data-wow-delay="0.8" style="border-bottom:2px solid rgb(210, 210, 210)">

                    
                    <div class="col-lg-6 justify-content-start wow fadeInUp" data-wow-delay="0.1s">
                        <a href='{{ 'blog/'.sluggify($blog->title) }}'>
                        <h2 class="mb-3">{{ Str::limit($blog->title, 200) }}</h2>
                        <p >Posted on: {{ $blog->created_at->format('M d, Y') }} by Admin</p>
                        <p class="mb-2">{!! Str::limit(strip_tags($blog->content), 200) !!}</p>
                        {{-- <a href="{{ route('showBlog', $blog) }}" style="background-color: #42CD34; color: #FFFFFF;" class="btn py-sm-3 px-sm-5 rounded-pill mt-3">{{__('description.read_more')}}</a> --}}
                        </a>    
                    </div>

                    @if($blog->featured_image)
                        <div class="col-lg-4">                
                            <a href='{{ 'blog/'.sluggify($blog->title) }}'>
                            <img class="img-fluid rounded wow zoomIn" style="width:80%;height:200px;object-fit:cover;" data-wow-delay="0.5s" src="{{ asset('storage/app/' . $blog->featured_image) }}">
                            </a>
                        </div>
                    @endif
                    

                </div>
            </div>
        </div>
        <br>
    @endforeach
{{-- Blog AREA END --}}

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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" style="background-color: #42CD34; color: #FFFFFF;" class="btn btn-lg btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>
