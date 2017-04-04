@extends('admin.layouts.admin_panel')

@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Manage Advertisement <small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <p class="text-muted font-13 m-b-30">
                                
                            </p>
                            <div class="table-responsive">
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Detail</th>
                                        <th>Added On</th>
                                        <th>Validity (days)</th>
                                        <th>Status</th>
                                        <th>Activated On</th>
                                        <th></th>
                                    </tr>

                                    </thead>


                                    <tbody>
                                    @foreach($advertisement as $advertisement)
                                    <tr>
                                        <td>{{$advertisement->id}}</td>
                                        <td>{{$advertisement->title}}</td>
                                        <td>{{$advertisement->detail}}</td>
                                        <td>{{$advertisement->created_at}}</td>
                                        <td>{{$advertisement->validity}}</td>
                                        <td>{{($advertisement->published_on != null) ? 'Active' : 'Not Active'}}</td>
                                        
                                        <td>{{$advertisement->published_on}}</td>
                                        <td>
                                            <a href="{{'advertisement/edit/'.$advertisement->id}}" class="btn btn-default"><span class="fa fa-pencil-square-o"></span></a>
                                            <a href="{{'advertisement/delete/'.$advertisement->id}}" class="btn btn-danger"><span class="fa fa-trash"></span></a>
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
    </div>
@endsection

@include('admin.includes.datatable_links')