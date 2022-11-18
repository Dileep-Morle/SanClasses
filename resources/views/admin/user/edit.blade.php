@extends('admin.layouts.app')

@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                 Create
                </h2>
                <div class="text-muted mt-1">new user</div>
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
                    <div class="card-header">
                        <h3 class="card-title">User Register Form</h3>
                    </div>
                   <div class="card-body">
                        <form action="{{ route('user-update', ['id' =>$user->id]) }}" method="post">
                             @csrf
                              @method('post')
                            <div class="form-group mb-3 ">
                                <label class="form-label">Name</label>
                                <div >
                                <input type="hidden" name="id" class="form-control" value="{{ $user->id; }}" >
                                <input type="text" name="name" class="form-control" value="{{ $user->name; }}" aria-describedby="nameHelp">
                                <small class="form-hint"></small>
                            </div>
                            </div>
                            <div class="form-group mb-3 ">
                            <label class="form-label">Email address</label>
                            <div >
                                <input type="email" name="email" class="form-control" value="{{ $user->email; }}" aria-describedby="emailHelp">
                                <small class="form-hint"></small>
                            </div>
                            </div>
                            <div class="form-group mb-3 ">
                            <label class="form-label">Edit User Type</label>
                            <div >
                                <input type="text" name="is_instructor" class="form-control" value="{{ $user->is_instructor; }}" aria-describedby="emailHelp">
                                <small class="form-hint"></small>
                            </div>
                            </div>
                            <div class="form-group mb-3 ">
                            <label class="form-label">Password</label>
                            <div >
                                <input type="text" name="password" class="form-control" value="{{ $user->password; }}" placeholder="Password">
                                <small class="form-hint"></small>
                            </div>
                            </div>
                            <div class="form-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        </div>
                    </div>
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