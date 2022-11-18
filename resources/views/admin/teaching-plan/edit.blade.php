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
                Teaching Plan Edit
                </h2>
                <div class="text-muted mt-1">Teaching Plan edit</div>
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
                        <form action="{{ route('teaching-plan-update', ['id' =>$teachplanedit->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="form-group mb-3 ">
                                <label class="form-label">Minute</label>
                                <div >
                                    <input type="hidden" name="id" class="form-control" value="{{ $teachplanedit->id; }}" >
                                    <input type="text" name="minute" class="form-control" value="{{ $teachplanedit->minute; }}" aria-describedby="minuteHelp" placeholder="Enter minute">
                                    <small class="form-hint"></small>
                                    <span class="p">
                                        @error('minute')
                                        {{$message}}
                                        @enderror
                                </span>
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                                <label class="form-label">Days</label>
                                <div >
                                    <input type="number" name="days" class="form-control" value="{{ $teachplanedit->days; }}" aria-describedby="daysHelp" placeholder="Enter days">
                                    <small class="form-hint"></small>
                                    <span class="p">
                                        @error('days')
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