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
                Lesson Edit
                </h2>
                <div class="text-muted mt-1">Lesson edit</div>
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
                        <form action="{{ route('lessons-update', ['id' =>$editlesson->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group mb-3 ">
                                <label class="form-label">Title</label>
                                <div >
                                    <input type="hidden" name="id" class="form-control" value="{{ $editlesson->id; }}" >
                                    <input type="text" name="title" class="form-control" value="{{ $editlesson->title; }}" aria-describedby="nameHelp" placeholder="Enter title">
                                    <small class="form-hint"></small>
                                    <span class="p">
                                        @error('title')
                                        {{$message}}
                                        @enderror
                                </span>
                                </div>
                            </div>
                           <div class="form-group mb-3 ">
                                <label class="form-label">Descreption</label>
                                <div >
                                    <textarea id="summernote" name="descreption" class="form-control" aria-describedby="descreptionHelp">{{ strip_tags($editlesson->descreption); }}</textarea>
                                    <small class="form-hint"></small>
                                    <span class="p">
                                        @error('descreption')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Update Files</label>
                                <div>
                                    <input type="file" id="lesson_file" name="lesson_file" class="form-control" value="{{ $editlesson->lesson_file; }}"><br>
                                    <iframe id="preview-lesson_file-before-upload" src="/public/lesson/{{ $editlesson->lesson_file }}" style="max-height: 150px;"></iframe>
                                    <small class="form-hint"></small>
                                    <span class="p">
                                        @error('lesson_file')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <label class="form-label">SELECT ONE</label>
                                <div>
                                <input type="text" id="is_paid" name="is_paid" class="form-control" value="{{ $editlesson->is_paid; }}">
                                <small class="form-hint"></small>
                                <span class="p">
                                    @error('is_paid')
                                    {{$message}}
                                    @enderror
                                </span>
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
    $('#lesson_file').change(function(){     
        let reader = new FileReader();
        reader.onload = (e) => {    
            $('#preview-lesson_file-before-upload').attr('src', e.target.result); 
            }
        reader.readAsDataURL(this.files[0]); 
    });
});
</script>
@endsection