@extends('admin.layouts.app')

@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    Lesson
                </h2>
                <!-- <div class="text-muted mt-1">1-18 of 413 people</div> -->
                    <!-- @if(session()->has('status'))
                      <div style="color:green">{{session('status')}}</div>
                    @endif -->
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="d-flex">
                    <div style="padding-right: 10px;">
                        <form action="{{ route('lessons') }}" method="GET">
                            <input type="search" name="search" id="search" class="form-control d-inline-block w-9 me-3" placeholder="Search lesson…" required/>
                        </form>
                    </div>
                    <!-- <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…" /> -->
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>

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
                                    <th>Title</th>
                                    <th>Descreption</th>
                                    <th>is paid</th>
                                    <th>Created Date</th>
                                    <th>File Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($addlesson as $lesson)
                                <tr>
                                    <td><span class="text-muted">{{$lesson->id}}</span></td>
                                    <td>{{$lesson->title}}</td>
                                    <td>{{strip_tags($lesson->descreption)}}</td>
                                    <td>{{$lesson->is_paid}}</td>
                                    <td>{{$lesson->created_at}}</td>
                                    <td>{{$lesson->file_type}}</td>
                                    <td class="text-end">
                                        <span class="dropdown">
                                            <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{route('lessons-edit', $lesson->id)}}">
                                                    Edit
                                                </a>
                                                <a class="dropdown-item" href="{{route('lessons-destroy', $lesson->id)}}">
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

                        <p class="m-0 text-muted">Showing <span>{{ $addlesson->firstItem() }}</span> to <span>{{ $addlesson->lastItem() }}</span> of <span>{{ $addlesson->total() }}</span> entries</p>
                        <ul class="pagination m-0 ms-auto">
                        {!! $addlesson->links() !!}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection