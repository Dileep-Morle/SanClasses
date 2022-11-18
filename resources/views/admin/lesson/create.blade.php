@extends('admin.layouts.app')
@section('style')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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
#more {display: none;}

.modal-backdrop {
  z-index: 0 !important;
}
</style>
@endsection
@section('content')
<div class="container-xl">
  <!-- Page title -->
  <div class="page-header d-print-none">
    <div class="row align-items-center">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col-3">
                <img src="{{url('public/course-image/',['feature_image'=>$course->feature_image])}}" height="200px" alt="Food Deliver UI dashboards" class="rounded">
              </div>
              <div class="col">
                <h1>
                  Tittle:- {{ $course->title }}
                </h1>
                <div class="text-muted">
                <h3>Created:- {{ $course->created_at }}</h3>
                </div>
                <div>
                  <h3>Descreption:-</h3>
                  <div id="shortdesc" style="display:block">
                      <p>{{  substr($course->descreption, 0, 200); }}</p>
                  </div>
                  <div id="collapse" style="display:none">
                      <p>{{ $course->descreption }}</p>
                  </div>

                  <a href="#collapse" class="nav-toggle">Read More</a>
                  </div>
                </div>
                <div class="col-auto">
                  <div class="dropdown">
                    <a href="#" class="card-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                      <!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="19" r="1"></circle><circle cx="12" cy="5" r="1"></circle></svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                      <a href="#" class="dropdown-item">Import</a>
                      <a href="#" class="dropdown-item">Export</a>
                      <a href="#" class="dropdown-item">Download</a>
                      <a href="#" class="dropdown-item">Another action</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
            <div class="card-header ">
              <div class="col">
                <h3 class="card-title">Lesson List ({{$arrayLength}})</h3>
                @if(session()->has('status'))
                  <div style="color:green">{{session('status')}}</div>
                @endif
              </div>
              <div class="col-auto ms-auto d-print-none">
                <a href="#" class="btn btn-primary" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                  </svg>
                  Add New Lesson
                </a>
              </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Lesson</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="{{ route('lessons.store',['id'=>$course->id])}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{old('title')}}" aria-describedby="nameHelp" placeholder="Enter title">
                        <small class="form-hint"></small>
                        <span class="p">
                          @error('title')
                          {{$message}}
                          @enderror
                        </span>
                      </div>
                      <div class="form-group">
                        <label class="form-label">Descreption</label>
                        <div >
                          <textarea name="descreption" class="form-control summernote" hight="500" aria-describedby="descreptionHelp">{{strip_tags(old('descreption'))}}</textarea>
                          <small class="form-hint"></small>
                            <span class="p">
                              @error('descreption')
                              {{$message}}
                              @enderror
                          </span>
                        </div>
                      </div>
                      <div class="form-group">

                      <label for="inp-img-vid">Seleect File</label>
                      <div>
                        <input type="file" accept="image/*, video/*, audio/*" name="lesson_file" class="form-control" id="inp-img-vid">
                        <div class="display-img-vid-con" id="img-vid-con" ></div>
                          <small class="form-hint"></small>
                          <span class="p">
                            @error('lesson_file')
                            {{$message}}
                            @enderror
                          </span>
                        </div> 
                      </div>
                      <div class="form-group">
                        <label class="form-label">SELECT ONE</label>
                        <div >
                          <select name="is_paid" class="form-control">
                            <option value="1">PAID<option>
                            <option value="0">UNPAID<option>
                          </select>
                          <small class="form-hint"></small>
                          <span class="p">
                            @error('is_paid')
                            {{$message}}
                            @enderror
                          </span>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            @if($arrayLength===0)
            <div class="page-body">
              <div class="container-xl d-flex flex-column justify-content-center">
                <div class="empty">
                  <div class="empty-img"><img src="/admin/static/undraw_printing_invoices_5r4r.svg" height="128" alt="">
                  </div>
                  <p class="empty-title">No results found</p>
                  <p class="empty-subtitle text-muted">
                    Try adjusting your search or filter to find what you're looking for.
                  </p>
                  <div class="empty-action">
                      <!-- Download SVG icon from http://tabler-icons.io/i/plussss -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                      No any lessons are available
                    </a>
                  </div>
                </div>
              </div>
            </div>
            @else
            <div class="table-responsive">
              <table class="table card-table table-vcenter text-nowrap datalessontable">
                <thead>
                  <tr>
                    <th>Lesson File</th>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Descreption</th>
                    <th>File Type</th>
                    <th>is paid</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($datalesson as $lesson)
                    <tr>
                      <td>
                        @if($lesson->file_type=='mp4' || $lesson->file_type=='3gp')
                        <iframe src="{{ url('public/lesson/',$lesson->lesson_file) }}" style="height: 100px; width: 150px;"></iframe>
                        @elseif($lesson->file_type=='mp3' || $lesson->file_type=='mpeb' || $lesson->file_type=='ogg')
                        <audio controls>
                          <source src="{{ url('public/lesson/',$lesson->lesson_file) }}" style="height: 100px; width: 100px;">
                        </audio>  
                        @else
                        <img src="{{ url('public/lesson/',$lesson->lesson_file) }}" style="height: 100px; width: 150px;">
                        @endif                    
                      </td>
                      <td><span class="text-muted">{{$lesson->id}}</span></td>
                      <td>{{$lesson->title}}</td>
                      <td>{{strip_tags($lesson->descreption)}}</td>
                      <td>{{$lesson->file_type}}</td>
                      <td>@if($lesson->is_paid==1) Paid @else Unpaid @endif</td>
                      <td>{{$lesson->created_at}}</td>
                      <td>
                        <span class="dropdown">
                          <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                          <div class="dropdown-menu dropdown-menu-left">
                            <a class="dropdown-item" href="{{route('lessons-edit', $lesson->id)}}">
                              Edit
                            </a>
                            <a class="dropdown-item" href="{{route('lessons-destroy',['id'=>$lesson->id])}}">
                              Delete
                            </a>
                          </div>
                        </span>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
        
            @endif
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
</div>
@endsection
@section('javascript')
    
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    $('.summernote').summernote();
  });

  $(document).ready(function () {
    $('.nav-toggle').click(function () {
        var collapse_content_selector = $(this).attr('href');
        var toggle_switch = $(this);
        $(collapse_content_selector).toggle(function () {
            if ($(this).css('display') == 'none') {
                  $("#shortdesc").show();
                toggle_switch.html('Read More');
            } else {
              toggle_switch.html('Read Less');
              $("#shortdesc").hide();
            }
        });
    });
  });

  //$("#inp-img-vid").change( function(){ imgPreview(this); } );
  document.getElementById("inp-img-vid").addEventListener("change", onFileSelected, false);
  var tmpElement;
  var file, file_ext, file_path, file_type, file_name;
  function show_Info_popUP()
  {
  alert("File is selected... " + "\n name : " + file_name  + "\n type : " + file_type + "\n ext : " + file_ext );
  }

  function onFileSelected ( input )
  {
    if( input.target.files[0] )
    {
        file = input.target.files[0];
        
        file_ext;
        file_type = file.type; file_name = file.name;
        file_path = (window.URL || window.webkitURL).createObjectURL(file);

        file_ext = file_name.toLowerCase();
        file_ext = file_ext.substr( (file_ext.lastIndexOf(".")+1), (file_ext.length - file_ext.lastIndexOf(".")) );
        
        file_type = file_type.toLowerCase();
        file_type = file_type.substr( 0, file_type.indexOf("/") );
        
        let reader = new FileReader();
        reader.readAsDataURL(file);
        
        reader.onloadend = function(evt) 
        { 
          show_Info_popUP();
            if (evt.target.readyState == FileReader.DONE) 
            {
                let container = document.getElementById("img-vid-con");
                while (container.firstChild)  
                { container.removeChild(container.firstChild); }
                if ( file_type == "image" )
                {
                  tmpElement = document.createElement( "img");
                  tmpElement.setAttribute("id", "preview-img");
                }
                if ( file_type == "video" )
                {
                    tmpElement = document.createElement( "video");
                    tmpElement.setAttribute("id", "preview-vid");
                    tmpElement.setAttribute("controls", "true" );
                    
                    tmpElement.addEventListener("loadeddata", () => 
                    {
                        if (tmpElement.readyState >= 3) 
                        { 
                          tmpElement.muted = true;
                          tmpElement.play();
                        }
            
                    }); 
                }
                if ( file_type == "audio" )
                {
                    tmpElement = document.createElement( "audio");
                    tmpElement.setAttribute("id", "preview-vid");
                    tmpElement.setAttribute("controls", "true" );
                    
                    tmpElement.addEventListener("loadeddata", () => 
                    {
                        if (tmpElement.readyState >= 3) 
                        { 
                          tmpElement.muted = true;
                          tmpElement.play();
                        }
            
                    }); 
                }
                
                tmpElement.width = 200; tmpElement.height = 200;
                tmpElement.setAttribute("src", file_path);
                container.appendChild(tmpElement);
            }
        
        }
        
    }
  }
    
</script>  
    @endsection