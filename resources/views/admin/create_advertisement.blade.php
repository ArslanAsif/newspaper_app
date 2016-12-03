@extends('admin.layouts.admin_panel')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Add Advertisement <small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            @if($check=="edit")
                                @foreach($advertisement as $advertisement)
                                <form action="{{url('admin/advertisement/edit/'.$advertisement->id)}}" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="title" required="required" class="form-control col-md-7 col-xs-12" value="{{$advertisement->title}}">
                                            <input type="hidden" name="id" required="required"  class="form-control col-md-7 col-xs-12" value="{{$advertisement->id}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Url <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="url" name="url" required="required" class="form-control col-md-7 col-xs-12" value="{{$advertisement->url}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="detail" class="control-label col-md-3 col-sm-3 col-xs-12">Detail </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea id="detail" class="form-control col-md-7 col-xs-12" name="detail" >{{$advertisement->detail}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Position</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control" name="position">
                                                <option value="Top">Top</option>
                                                <option value="Bottom">Bottom</option>
                                                <option value="Right">Right</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <div class="">
                                                <label>
                                                    @if($advertisement->validity==1)
                                                    <input type="checkbox"checked  class="js-switch" name="status" /> Active
                                                    @else
                                                        <input type="checkbox"  class="js-switch" name="status"/>In Active
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>

                                </form>
                                @endforeach
                            @else
                            <form action="{{url('admin/advertisement/add')}}" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="title" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Url <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="url" name="url" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="detail" class="control-label col-md-3 col-sm-3 col-xs-12">Detail </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="detail" class="form-control col-md-7 col-xs-12" name="detail"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Position</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="position">
                                            <option value="Top">Top</option>
                                            <option value="Bottom">Bottom</option>
                                            <option value="Right">Right</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>

                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <!-- Switchery -->
    <link href="{{ url('vendors/switchery/dist/switchery.min.css') }}" rel="stylesheet">
@endsection

@section('js')
    <!-- Switchery -->
    <script src="{{ url('vendors/switchery/dist/switchery.min.js') }}"></script>
@endsection