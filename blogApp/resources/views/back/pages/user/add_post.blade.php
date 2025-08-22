@extends('back.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Page Title Here')

@section('content')

    {{-- top section --}}
    <section>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Add Post</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('user.dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Add Post
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a class="btn btnPers" href="{{ route('user.posts') }}">
                    View all Posts
                </a>
            </div>
        </div>
    </section>

    {{-- form starts here --}}
    <form action="{{route('user.create_post')}}" method="POST" autocomplete="off" enctype="multipart/form-data" id="addPostForm">
        @csrf
        <section class="row">
            <section class="col-md-9">

                <section class="card card-box my-2">
                    <div class="card-body">

                        {{-- post top section --}}
                        <div class="form-group">
                            <label for="title"><b>Title</b></label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Post Title">
                            <span class="text-danger error-text title_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="content"><b>Content</b></label>
                            <textarea name="content" id="content" cols="30" rows="10" class="ckeditor form-control" placeholder="Enter post content"></textarea>
                            <span class="text-danger error-text content_error"></span>

                        </div>
                    </div>
                </section>

                {{-- post bottom section --}}
                {{-- <section class="card card-box my-2">
                    <div class="card-header weight-500">SEO</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="meta_keywords">
                                <b>Post Meta Keywords</b>
                                <small>(Separated by comma)</small>
                            </label>
                            <input type="text" class="form-control" name="meta_keywords" placeholder="Enter post meta keywords">
                            
                            <div class="form-group mt-4">
                                <label for="meta_description">
                                    <b>Post Meta Description</b>
                                </label>
                                <textarea name="meta_description" id="" cols="30" rows="10" class="form-control" placeholder="Enter post meta description"></textarea>
                            </div>
                        </div>
                    </div>
                </section> --}}
            </section>

            {{-- post right section --}}
            <section class="col-md-3">
                <section class="card card-box mb-2">
                    <section class="card-body">

                        <div class="form-group">
                            <label for="category">
                                <b>Post Category</b>
                            </label>
                            <select name="category" id="" class="custom-select form-control">
                                <option value="">
                                    Choose
                                </option>
                                {{!!$categories_html!!}}
                            </select>
                            <span class="text-danger error-text category_error"></span>
                        </div>

                        <div class="form-group">
                            <label for="featured_image">
                                <b>Post Featured image</b>
                            </label>
                            <input type="file" name="featured_image" class="form-control-file form-control" height="auto">
                            <span class="text-danger error-text featured_image_error"></span>
                        </div>

                        <div class="mb-3 d-block" style="max-width: 250px;">
                            <img src="" alt="" class="img-thumbnail" id="featured_image_preview">
                        </div>

                        <div class="form-group">
                            <label for="tags"><b>Tags</b></label>
                            <input type="text" class="form-control" name="tags" data-role="tagsinput">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="visibility"><b>Visibility</b></label>

                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" name="visibility" id="customRadio1" class="custom-control-input" value="1" checked>
                                <label for="customRadio1" class="custom-control-label">Public</label>
                            </div>

                            <div class="custom-control custom-radio mb-5">
                                <input type="radio" name="visibility" id="customRadio2" class="custom-control-input" value="0" checked>
                                <label for="customRadio2" class="custom-control-label">Private</label>
                            </div>
                        </div>

                    </section>
                </section>

            </section>
        </section>

        <div class="my-4">
            <button type="submit" class="btn btnPers">Create Post</button>
        </div>


    </form>

@endsection

@push('stylesheets')
    <link rel="stylesheet" href="{{asset('/backend/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
@endpush

@push('scripts')
    <script src="{{asset('/backend/src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js')}}"></script>

    {{-- ckeditor link --}}
    <script src="{{asset('/ckeditor/ckeditor.js')}}"></script>
    

    <script>
        // img preview
        $('input[name="featured_image"]').change(function(e){
            if(this.files && this.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#featured_image_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });


        // post create functionality
        $('#addPostForm').on('submit', function(e){
            e.preventDefault();
            var form = this;
            var content = CKEDITOR.instances.content.getData();
            var formdata = new FormData(form);
            formdata.append('content',content);

            $.ajax({
                url:$(form).attr('action'),
                method:$(form).attr('method'),
                data:formdata,
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                    $(form).find('span.error-text').text('');
                },
                success:function(data){
                    if(data.status == 1){
                        $(form)[0].reset();
                        CKEDITOR.instances.content.setData('');
                        $('input[name="tags"]').tagsinput('removeAll');
                        $('#featured_image_preview').attr('src','');
                        $().notifa({
                            vers:2,
                            cssClass: 'success',
                            html:data.message,
                            delay:2500
                        });
                    }else{
                        $().notifa({
                            vers:2,
                            cssClass: 'error',
                            html:data.message,
                            delay:2500
                        });
                    }
                },
                error:function(data){
                    $.each(data.responseJSON.errors, function(prefix,val){
                        $(form).find('span.'+prefix+'_error').text(val[0]);
                    });
                }
            });
        });
    </script>
@endpush
