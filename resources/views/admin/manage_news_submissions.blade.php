@extends('admin.layouts.admin_panel')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>User Submissions <small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <p class="text-muted font-13 m-b-30">
                                User submitted news, articles and colums can be reviewed here for publishing. Once Published it will be moved to news tab.
                            </p>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Submitted On</th>
                                    <th></th>
                                </tr>
                                </thead>


                                <tbody>

                                @foreach($news as $this_news)
                                <tr>
                                    <td>{{ $this_news->title }}</td>
                                    <td>{{ $this_news->type }}</td>
                                    <td>{{ $this_news->category->name }}</td>
                                    <td>{{ $this_news->user->name }}</td>
                                    <td>{{ $this_news->created_at }}</td>
                                    <td>
                                        <a href="{{ url('/admin/news/edit/'.$this_news->id) }}" class="btn btn-default"><span class="fa fa-pencil-square-o"></span></a>
                                        <a href="{{ url('/admin/news/delete/'.$this_news->id) }}" class="btn btn-danger"><span class="fa fa-trash-o"></span></a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('admin.includes.datatable_links')