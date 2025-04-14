{{-- add.blade.php --}}
@extends('Super_Admin.layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
  .editor p,h1,h2,h3,h4,ol{
     margin-top:15px !important;
  }
</style>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.snow.css" rel="stylesheet" />
    <div class="container" id="add_blog">
        <div class="row">
          <div class="col-sm-8">
            <h1>@lang('common.Blog Management')</h1>
          </div>
          <div class="col-md-4 text-right">
              <br>
                <a href="{{ route('blogs.index') }}" class="btn btn-primary btn-sm my-3"><i class="fa fa-arrow-left me-2" aria-hidden="true"></i> @lang('Company_Admin/dashboard.Back')</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                      @lang('common.Create new blog')
                  </div>
                  <!-- /.panel-heading -->
                  <div class="panel-body">
                    <form name="myForm" method="POST" @submit.prevent="doSubmit" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
                      @csrf

                      <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" id="title" name="title" required>
                      </div>

                      <div class="form-group">
                          <label for="content">Content</label>
                          <div id="editor" class="editor" style="height:600px;font-size:1.4rem;"></div> 
                          <input id="content" name="content" type="hidden">                 
                      </div>

                      <div class="form-group">
                          <img src="https://via.placeholder.com/1200x630" style="width:300px" alt="Placeholder Image">
                          <br>
                          <label for="featured_image">Featured Image</label>
                          <input type="file" class="form-control-file" id="featured_image" name="featured_image">
                      </div>

                      <button  type="submit" class="btn btn-primary">Create Blog</button>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.1/dist/quill.js"></script>

<script src="{{asset('public/js/vue.min.js')}}"></script>
<script>
      new Vue({
         el: '#add_blog',
         data: {
           quill:null,
           sendImage:null,
         },
         mounted(){

              this.quill = new Quill('#editor', {
                  theme: 'snow',
                  height: 800,
                  modules: {
                      toolbar: [
                        [{ font: [] }],
                        [{ header: [1, 2, 3, 4, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        //[{ script: 'sub' }, { script: 'super' }],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        ['clean'],
                        //['code-block'],
                        //['formula'],
                        //[{ header: 1 }, { header: 2 }],
                        //[{ indent: '-1' }, { indent: '+1' }],
                        //[{ direction: 'rtl' }],
                        //[{ size: ['small', false, 'large', 'huge'] }], 
                        [{ color: [] }, { background: [] }],
                        [{ align: [] }],
                        ['link', 'image'],
                          ],
                        },
                  placeholder: 'Start writing your blog post...',
                  readOnly: false,
                  bounds: document.body,
                  scrollingContainer: document.body,
                  //debug: 'info',
                            });

         },
         methods: {
          doSubmit(){
            //document.myForm.content.value = JSON.stringify(this.quill.getContents());
            document.myForm.content.value = this.quill.root.innerHTML;
            document.myForm.submit();
            return true;
          },
         }
      });
</script>

@endsection