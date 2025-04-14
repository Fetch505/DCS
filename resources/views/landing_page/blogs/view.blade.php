<!DOCTYPE html>
<html lang="en">
<head>
    @include('landing_page.partials._header')
    @yield('outer_css')
</head>
<body id="page-top">
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

    <!-- Advanced Feature Start -->
    {{-- <div class="container-xxl position-relative py-6" id="features">
      <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="mx-auto text-start wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3 text-primary">@lang('common.Blog Management')</h1>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-end">
                    <a class="btn btn-primary btn-md" href="{{ route('blog') }}">
                        <i class="fa fa-arrow-left me-2" aria-hidden="true"></i>
                        @lang('Company_Admin/dashboard.Back')
                    </a>
                </div>
            </div>
        </div>
      </div>
    </div> --}}
    <!-- Advanced Feature End -->

     <!-- Advanced Feature End -->
     <style>
      .blog_style{
          color: #202942;
          line-height: 2.1rem;
      }
      
      h2{
          text-align: start;
          padding: 0px;
      }
     </style>

     <div class="container position-relative " style="padding:8rem  0px !important">
        <div class="row mb-5">
            <div class="col-lg-12 mx-3">
              
                <div class="blog_style"  style="display:flex;flex-wrap:wrap;align-content:center;justify-content: center; font-size:1.3rem;">
                 
                  <div class="col-lg-7 justify-content:start">
                    <p style="font-size: 0.9rem"><a href="{{url('/')}}">Home</a> / <a href="{{route('blog')}}">Blog</a> / {{ $blog->title }}</p>
                  </div>

                  <div class="col-lg-7 mb-4" style="display:flex;align-content: center;justify-content: center;">
                    @if ($blog->featured_image)
                      <img src="{{ asset('storage/app/' . $blog->featured_image) }}" alt="{{ $blog->title }}" style="width:80%;height:300px;object-fit:cover;">
                    @endif
                  </div>

                  <div class="col-lg-8 ">
                    <div>              
                      <h1>{{ $blog->title }}</h1>
                      <p style="font-size:1rem;">Posted on: {{ $blog->created_at->format('M d, Y') }} by Admin</p>
                    </div>                   
                      <div>{!! $blog->content !!}</div>
                  </div>
  
                </div>
          </div>
        </div>
    </div>
    </div>
  @include('landing_page.partials._scripts')

</body>
</html>