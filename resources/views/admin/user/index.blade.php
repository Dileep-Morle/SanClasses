@extends('admin.layouts.app')

@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Users
                </h2>
                <!-- <div class="text-muted mt-1">1-18 of 413 people</div> -->
                    @if(session()->has('status'))
                      <div style="color:green">{{session('status')}}</div>
                    @endif
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                <div style="padding-right: 10px;">
                        <form action="{{ route('users') }}" method="GET">
                            <input type="search" name="search" id="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…" required/>
                        </form>
                    </div>
                    <!-- <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…" /> -->
                    <a href="{{route('user-create')}}" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        New user
                    </a>
                </div>
            </div>
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
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            No any users are available
        </a>
        </div>
    </div>
  </div>
</div>
@else
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th> 
                                    <th>Status</th>
                                    <th>User Type</th>                                 
                                    <th>Created</th>                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($users as $user)
                                        <tr>
                                            <td><span class="text-muted">{{$user->id;}}</span></td>
                                            <td><a href="invoice.html" class="text-reset" tabindex="-1">{{ $user->name; }}</a></td>
                                          
                                            <td>{{ $user->email; }}</td>                                         
                                            <td><span class="badge bg-success me-1"></span> Active</td>
                                            <td>@if($user->is_instructor==1) Instuctor @else Student @endif</td>
                                            <td> {{ $user->created_at; }}</td>
                                            <td>
                                                <span class="dropdown">
                                                    <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                                    <div class="dropdown-menu dropdown-menu-left">
                                                        <a class="dropdown-item" href="{{route('user-edit', $user->id)}}">
                                                            Edit
                                                        </a>
                                                        <a class="dropdown-item" href="{{route('user-destroy', $user->id)}}">
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
                    <div class="card-footer d-flex align-items-center">
                       <p class="m-0 text-muted">Showing <span>{{ $users->firstItem() }}</span> to <span>{{ $users->lastItem() }}</span> of <span>{{ $users->total() }}</span> entries</p>
                        <ul class="pagination m-0 ms-auto">
                        {!! $users->links() !!}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection