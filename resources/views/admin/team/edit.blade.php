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
                Team Edit
                </h2>
                <div class="text-muted mt-1">team edit</div>
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
                        <form action="{{ route('team-update', ['id' =>$teamedit->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group mb-3 ">
                                <div >
                                    <label class="form-label">Name</label>
                                    <input type="hidden" name="id" class="form-control" value="{{ $teamedit->id }}" >
                                    <input type="text" name="name" class="form-control" value="{{ $teamedit->name }}" aria-describedby="nameHelp" placeholder="Enter name">
                                    <small class="form-hint"></small>
                                    <span class="p">
                                        @error('name')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <label class="form-label">Descreption</label>
                                <div >
                                    <textarea name="descreption" class="form-control summernote" aria-describedby="descreptionHelp">{{strip_tags($teamedit->descreption)}}</textarea>
                                    <small class="form-hint"></small>
                                    <span class="p">
                                        @error('descreption')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <label class="form-label">Profile Image</label>
                                <div >
                                    <input type="file" id="image" name="photo" class="form-control"><br>
                                    <img src="/public/team-image/{{ $teamedit->photo }}" id="preview-image-before-upload" width="150px">
                                    <small class="form-hint"></small>
                                    <span class="p">
                                        @error('photo')
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