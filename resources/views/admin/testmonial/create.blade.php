@extends('admin.layouts.app')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<!-- Cropper CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/cropper/2.3.4/cropper.min.css'>
<style>
.p{
    color:red;
}
.alert-success{
    color:green;
}
.alert-danger{
    color:red;
}

.page {
	margin: 1em auto;
	max-width: 768px;
	display: flex;
	align-items: flex-start;
	flex-wrap: wrap;
	height: 100%;
}

.box {
	padding: 0.5em;
	width: 100%;
	margin: 0.5em;
}

.box-2 {
	padding: 0.5em;
	width: calc(100%/2 - 1em);
}

.options label,
.options input {
	width: 4em;
	padding: 0.5em 1em;
}

.btn {
	background: white;
	color: black;
	border: 1px solid black;
	padding: 0.5em 1em;
	text-decoration: none;
	margin: 0.8em 0.3em;
	display: inline-block;
	cursor: pointer;
}

.hide {
	display: none;
}

img {
	max-width: 100%;
}
</style>
@endsection
@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                 Add Testmonial
                </h2>
                <div class="text-muted mt-1"> Add Testmonial</div>
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
                        <form action="{{route('testmonial-store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group mb-3 ">
                                <label class="form-label">Name</label>
                                <div >
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}" aria-describedby="nameHelp" placeholder="Enter name">
                                    <small class="form-hint"></small>
                                    <span class="p">
                                        @error('name')
                                        {{$message}}
                                        @enderror
                                </span>
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <label class="form-label">Rating</label>
                                <div >
                                    <input type="number" name="rating" class="form-control" value="{{old('rating')}}" aria-describedby="ratingHelp" placeholder="Enter rating">
                                    <small class="form-hint"></small>
                                    <span class="p">
                                        @error('rating')
                                        {{$message}}
                                        @enderror
                                </span>
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <label class="form-label">Comment</label>
                                <div >
                                    <textarea name="comment" cols="4" rows="10" class="form-control summernote"  aria-describedby="commentHelp">{{strip_tags(old('comment'))}}</textarea>
                                    <small class="form-hint"></small>
                                    <span class="p">
                                        @error('comment')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <div >
                                    <label class="form-label">Profile Image</label>
                                    <div class="box">
                                        <input type="file" id="file-input" name="profile" class="form-control">
                                    </div>
                                    <div class="box-2">
                                        <div class="result"></div>
                                    </div>
                                    <div class="box-2 img-result hide">
                                        <img class="cropped" src="" alt="">
                                    </div>
                                    <div class="box">
                                        <div class="options hide">
                                            <label> Width</label>
                                            <input type="number" class="img-w" value="300" min="100" max="1200" />
                                        </div>
                                        <button class="btn save hide">Save</button>
                                        <a href="" class="btn download hide">Download</a>
                                    </div>
                                    <small class="form-hint"></small>
                                    <span class="p">
                                        @error('profile')
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
<script src='https://cdnjs.cloudflare.com/ajax/libs/cropperjs/0.8.1/cropper.min.js'></script>
<script type="text/javascript">

let result = document.querySelector('.result'),
img_result = document.querySelector('.img-result'),
img_w = document.querySelector('.img-w'),
img_h = document.querySelector('.img-h'),
options = document.querySelector('.options'),
save = document.querySelector('.save'),
cropped = document.querySelector('.cropped'),
dwn = document.querySelector('.download'),
upload = document.querySelector('#file-input'),
cropper = '';

upload.addEventListener('change', e => {
  if (e.target.files.length) {
    const reader = new FileReader();
    reader.onload = e => {
      if (e.target.result) {
        let img = document.createElement('img');
        img.id = 'image';
        img.src = e.target.result;
        result.innerHTML = '';
        result.appendChild(img);
        save.classList.remove('hide');
        options.classList.remove('hide');
        cropper = new Cropper(img);
      }
    };
    reader.readAsDataURL(e.target.files[0]);
  }
});

  save.addEventListener('click', e => {
  e.preventDefault();
  let imgSrc = cropper.getCroppedCanvas({
    width: img_w.value
  }).toDataURL();
  cropped.classList.remove('hide');
  img_result.classList.remove('hide');
  cropped.src = imgSrc;
  dwn.classList.remove('hide');
  dwn.download = '';
  dwn.setAttribute('href', imgSrc);
});
</script>
@endsection