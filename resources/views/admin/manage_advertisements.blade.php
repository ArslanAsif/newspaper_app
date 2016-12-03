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
                                DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>
                            </p>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Detail</th>
                                    <th>Position</th>
                                    <th>Added On</th>
                                    <th>Status</th>
                                    <th>Activated On</th>
                                    <th></th>
                                </tr>

                                </thead>


                                <tbody>
                                @foreach($advertisment as $advertisment)
                                <tr>
                                    <td>{{$advertisment->title}}</td>
                                    <td>{{$advertisment->detail}}</td>
                                    <td>{{$advertisment->position}}</td>
                                    <td>{{$advertisment->created_at}}</td>
                                    @if($advertisment->validity=="1")
                                    <td>Active</td>
                                    @else
                                    <td>In Active</td>
                                    @endif
                                    <td>{{$advertisment->created_at}}</td>
                                    <td>
                                        <a href="{{'advertisement/edit/'.$advertisment->id}}" class="btn btn-default"><span class="fa fa-pencil-square-o"></span></a>
                                        <a href="{{'advertisement/delete/'.$advertisment->id}}" class="btn btn-danger"><span class="fa fa-trash"></span></a>
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