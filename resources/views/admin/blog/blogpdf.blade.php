
<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th>Feature Image</th>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Meta Tag</th>
                                    <th>Content</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                   <td>{{$blogdata->img}}</td>
                                   <td>{{$blogdata->id}}</td>
                                   <td>{{$blogdata->title}}</td>
                                   <td>{{$blogdata->slug}}</td>
                                   <td>{{$blogdata->meta_tag}}</td>
                                   <td>{{$blogdata->content}}</td>
                                   <td>{{$blogdata->created_at}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
