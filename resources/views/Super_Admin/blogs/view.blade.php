{{-- view.blade.php --}}
@extends('Super_Admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
  <section class="content">
    <div class="container mt-5" style="overflow:hidden;">

      <div class="row">
          <div class="col-sm-8">
              <h1 class="text-primary">@lang('common.Blog Management')</h1>
          </div>
          <div class="col-md-4 text-right">
            <br>
              <a href="{{ route('blogs.index') }}" class="btn btn-primary btn-sm my-3"><i class="fa fa-arrow-left" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Back')</a>
              <a href="{{ route('blogs.edit',$blog->id) }}" class="btn btn-success btn-sm my-3"><i class="fa fa-pencil-square-o" style="color:white;"></i></a>
          </div>
      </div>

      <div class="row">
          <div class="col-lg-12">
              <div class="panel panel-info"  style="display:flex;flex-wrap:wrap;align-content:center;justify-content: center;font-size:1.8rem;">

                  <div class="panel-body" style="display:flex;align-content: center;justify-content: center;width:60%">
                    @if($blog->featured_image)
                      <img src="{{ asset('storage/app/' . $blog->featured_image) }}" alt="{{ $blog->title }}" style="width:80%;height:300px;object-fit:cover;">
                    @endif
                  </div>

                  <div class="" style="width:60%">              
                    <h1>{{ $blog->title }}</h1>
                    <p>Published on: {{ $blog->created_at->format('M d, Y') }}</p>
                    <br>
                    <div id="content">{!! $blog->content !!}</div>               
                  </div>

              </div>
            </div>
        </div>

    </div>
  </section>
@endsection



