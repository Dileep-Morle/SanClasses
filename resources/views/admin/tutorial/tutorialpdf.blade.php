
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
                                    <th>Slug</th>
                                    <th>Content</th>
                                    <th>Feature Image</th>
                                    <th>Video</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                   <td>{{$tutorialdata->id}}</td>
                                   <td>{{$tutorialdata->title}}</td>
                                   <td>{{$tutorialdata->slug}}</td>
                                   <td>{{$tutorialdata->content}}</td>
                                   <td>{{$tutorialdata->feature_image}}</td>
                                   <td>{{$tutorialdata->video}}</td>
                                   <td>{{$tutorialdata->created_at}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
