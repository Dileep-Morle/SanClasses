
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
                                    <th>Content</th>
                                    <th>Created</th>
                                    <th>Feature Image</th>
                                    <th>Document</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                   <td>{{$showdata->id}}</td>
                                   <td>{{$showdata->title}}</td>
                                   <td>{{$showdata->content}}</td>
                                   <td>{{$showdata->created_at}}</td>
                                   <td>{{$showdata->feature_image}}</td>
                                   <td>{{$showdata->doc_pdf}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
