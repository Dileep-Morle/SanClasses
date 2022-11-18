@extends('admin.layouts.app')
@section('style')
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

</style>
@endsection
@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                 Create User
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
                        <form action="{{route('user-store')}}" method="post">
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
                            <label class="form-label">Email address</label>
                            <div >
                                <input type="email" name="email" class="form-control" value="{{old('email')}}" aria-describedby="emailHelp" placeholder="Enter email">
                                <small class="form-hint"></small>
                                <span class="p">
                                    @error('email')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">User Type</label>
                                <div >
                                    <select name="is_instructor" class="form-control">
                                        <option value="1">Instructor<option>
                                        <option value="0">Student<option>
                                    </select>
                                    <small class="form-hint"></small>
                                    <span class="p">
                                        @error('is_instructor')
                                        {{$message}}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group mb-3 ">
                            <label class="form-label">Password</label>
                            <div >
                                <input type="password" name="password" value="{{old('password')}}" class="form-control" placeholder="Password">
                                <small class="form-hint"></small>
                                <span class="p">
                                    @error('password')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                            </div>
                            <div class="form-group mb-3 ">
                            <label class="form-label">Confirm Password</label>
                            <div >
                                <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" class="form-control" placeholder="Password">
                                <small class="form-hint"></small>
                                <span class="p">
                                    @error('password_confirmation')
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