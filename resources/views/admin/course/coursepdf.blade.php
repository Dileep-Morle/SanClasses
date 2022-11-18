
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
                                    <th>Feature Image</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                   <td>{{$coursedata->id}}</td>
                                   <td>{{$coursedata->title}}</td>
                                   <td>{{$coursedata->descreption}}</td>
                                   <td>{{$coursedata->img}}</td>
                                   <td>{{$coursedata->created_at}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
