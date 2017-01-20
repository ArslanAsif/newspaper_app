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
                                <form action="{{url(isset($advertisement) ? 'admin/advertisement/edit/'.$advertisement->id : 'admin/advertisement/add' )}}" method="post" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                                    {{csrf_field()}}

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"></label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <div class="">
                                                <label>
                                                <input type="checkbox" name="publish" {{ isset($advertisement) ? ($advertisement->published_on != '') ? 'checked' : '' : ''}}  class="js-switch"/>
                                                    
                                                    Enable
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" name="title" required="required" class="form-control col-md-7 col-xs-12" value="{{ isset($advertisement) ? $advertisement->title : ''}}">
                                            <input type="hidden" name="id" required="required"  class="form-control col-md-7 col-xs-12" value="{{ isset($advertisement) ? $advertisement->id : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Url <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input placeholder="http://www.exampleurl.com" type="text" id="url" name="url" required="required" class="form-control col-md-7 col-xs-12" value="{{ isset($advertisement) ? $advertisement->url : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="detail" class="control-label col-md-3 col-sm-3 col-xs-12">Detail </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea id="detail" class="form-control col-md-7 col-xs-12" name="detail" >{{ isset($advertisement) ? $advertisement->detail : '' }}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="duration" class="control-label col-md-3 col-sm-3 col-xs-12">Duration <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input required="required" placeholder="Days" type="number" id="duration" class="form-control col-md-7 col-xs-12" name="duration" value="{{ isset($advertisement) ? $advertisement->validity : '' }}" ></input>
                                        </div>
                                    </div>

                                    <!-- <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Position</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control" name="position">
                                                <option value="Top">Top</option>
                                                <option value="Bottom">Bottom</option>
                                                <option value="Right">Right</option>
                                            </select>
                                        </div>
                                    </div> -->

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ad Image</label>
                                        <div class="image-editor col-md-6">
                                            <input type="file" class="cropit-image-input">
                                            <div class="cropit-preview"></div>
                                            <div class="image-size-label">
                                                Resize image
                                            </div>
                                            <input type="range" class="cropit-image-zoom-input">
                                            <a class="btn btn-warning rotate-ccw"><span class="fa fa-rotate-left"></span></a>
                                            <a class="btn btn-warning rotate-cw"><span class="fa fa-rotate-right"></span></a>

                                            <input type="hidden" name="image-data" class="hidden-image-data" />
                                            <span class="pull-right">
                                                <a class="btn btn-default select-image-btn">Select new image</a>
                                            <a class="btn btn-success export">Upload</a>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>

                                </form>
                                
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

    <!-- cropit -->
    <style>
        .cropit-preview {
            background-color: #f8f8f8;
            background-size: cover;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-top: 7px;
            height: 240px;
            width: 320px;
        }

        .cropit-preview-image-container {
            cursor: move;
        }

        .image-size-label {
            margin-top: 10px;
        }

        input {
            display: block;
        }

        button[type="submit"] {
            margin-top: 10px;
        }

        #result {
            margin-top: 10px;
            width: 900px;
        }

        #result-data {
            display: block;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            word-wrap: break-word;
        }

        /* Hide file input */
        input.cropit-image-input {
            margin-bottom: -25px;
            visibility: hidden;
        }

    </style>
@endsection

@section('js')
    <!-- Switchery -->
    <script src="{{ url('vendors/switchery/dist/switchery.min.js') }}"></script>

    <!-- cropit -->
    <script src="{{ url('vendors/cropit/dist/jquery.cropit.js') }}"></script>

    <script>
        $(function() {
            $('.image-editor').cropit({
                smallImage: 'allow',
                imageState: {
                    src: '{{ isset($advertisement) ? url('images/advertisement/'.$advertisement->image) : '' }}',
                },
            });

            $('.rotate-cw').click(function() {
                $('.image-editor').cropit('rotateCW');
            });
            $('.rotate-ccw').click(function() {
                $('.image-editor').cropit('rotateCCW');
            });

            $('.export').click(function() {
                var imageData = $('.image-editor').cropit('export');
                $('.hidden-image-data').val(imageData);
            });
        });

        $('.select-image-btn').click(function() {
            $('.cropit-image-input').click();
        });
    </script>
@endsection