@extends('admin.layouts.app')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                Blog Category Edit
                </h2>
                <div class="text-muted mt-1">category edit</div>
            </div>
            <!-- Page title actions -->
           

        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('category-update', ['id' =>$category->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group mb-3 ">
                                <label class="form-label">Title</label>
                                <div >
                                    <input type="hidden" name="id" class="form-control" value="{{ $category->id; }}" >
                                    <input type="text" name="title" class="form-control" value="{{ $category->title; }}" aria-describedby="nameHelp" placeholder="Enter title">
                                    <small class="form-hint"></small>
                                    <span class="p">
                                        @error('title')
                                        {{$message}}
                                        @enderror
                                </span>
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <label class="form-label">Content</label>
                                <div >
                                    <textarea name="content" id="summernote" class="form-control summernote" aria-describedby="contentHelp">{{ strip_tags($category->content); }}</textarea>
                                    <small class="form-hint"></small>
                                    <span class="p">
                                        @error('content')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <label class="form-label">Update Feature Image</label>
                                <div >
                                    <input type="file" name="img" class="form-control" id="image"><br>
                                    
                                    <img src="/public/image/{{ $category->img }}" id="preview-image-before-upload" width="150px">
                                   
                                    <small class="form-hint"></small>
                                    <span class="p">
                                        @error('img')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal modal-blur fade" id="modal-create-resume" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-width modal-dialog-centered" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Resume</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci animi beatae delectus deleniti dolorem eveniet facere fuga iste nemo nesciunt nihil odio perspiciatis, quia quis reprehenderit sit tempora totam unde.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#summernote').summernote();
});

$(document).ready(function (e) {
    $('#image').change(function(){     
        let reader = new FileReader();
        reader.onload = (e) => {    
            $('#preview-image-before-upload').attr('src', e.target.result); 
            }
        reader.readAsDataURL(this.files[0]); 
    });
});
</script>
@endsection