{{-- index.blade.php --}}
@extends('Super_Admin.layouts.admin')

@section('title', 'Dashboard')
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>

@section('content')
<section class="container">
    <div class="row">
        <div class="col-sm-8">
            <h1 class="text-primary">@lang('common.Blog Management')</h1>
        </div>
        <div class="col-md-4 text-right">
          <br>
            <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-sm my-3"><i class="fa fa-plus me-2" aria-hidden="true"></i> @lang('common.Add new')</a>
        </div>
    </div>

    @php use Illuminate\Support\Str; @endphp

    
    <!-- Table to display list of blogs -->
            <!-- Table to display list of blogs -->
<div class="xcontainer">
    @if(count($blogs)>0)

      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col" class="text-center">Featured Image</th>
            <th scope="col" class="text-center">Title</th>
            <th scope="col" class="text-center">Content</th>
            <th scope="col" class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Loop through each blog and display the data -->
          
          
          @foreach($blogs as $blog)
          
          <tr class="my-auto align-items-center">
          
            <td class="text-center" style="vertical-align: middle;">
              @if($blog->featured_image)
                      <img src="{{ asset('storage/app/' . $blog->featured_image) }}" class="img-fluid rounded mb-4" style="position: relative; width:130px;;" alt="{{ $blog->title }}">
              @endif
            </td>
            <td class="text-center" style="vertical-align: middle;"><a href="{{ route('blogs.show', $blog)}}">{{ Str::limit($blog->title, 200)}}</a></td>
            <td class="text-center" style="vertical-align: middle;">{!! Str::limit(strip_tags($blog->content), 200) !!}</td></a>
            <td class="text-center" style="vertical-align: middle;">
              <a href="{{ route('blogs.show', $blog) }}" ><i class="fa fa-eye view-icon" style="color:blue"></i></a> 
              <a href="{{ route('blogs.edit', $blog->id) }}" ><i class="fa fa-pencil-square-o" style="color:green;"></i></a>
              <a href="{{ route('blogs.delete', $blog->id) }}" onclick="return confirm('Are you sure you want to delete this blog?');"><i class="fa fa-times" style="color:red;"></i></a>          
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

    @else
    <p >Click on Add button to add new Blog</p>
    @endif
   
  </div>
    
</section>
@endsection

  @section('outer_script')
  <script src="{{asset('public/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('public/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('public/vendor/datatables-plugins/dataTables.bootstrap.min.js')}}"></script>
  <script src="{{asset('public/vendor/datatables-responsive/dataTables.responsive.js')}}"></script>
  <script src="{{asset('public/dist2/js/sb-admin-2.js')}}"></script>
  @endsection
