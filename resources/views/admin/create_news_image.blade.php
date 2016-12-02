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
                            <h2>Upload News Image <small>Step 2 of 2</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />

                            <form action="#" class="form-horizontal form-label-left">
                                <div class="image-editor">
                                    <input type="file" class="cropit-image-input">
                                    <div class="cropit-preview"></div>
                                    <div class="image-size-label">
                                        Resize image
                                    </div>
                                    <input type="range" class="cropit-image-zoom-input">
                                    <input type="hidden" name="image-data" class="hidden-image-data" />

                                    <div class="ln_solid"></div>
                                    <div class="">
                                        <div class="pull-right">
                                            <button type="submit" class="btn btn-primary">Skip Image</button>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div id="result">
                                <code>$form.serialize() =</code>
                                <code id="result-data"></code>
                            </div>

                            {{--<form id="demo-form2" class="form-horizontal form-label-left">--}}

                                {{--<div class="form-group">--}}

                                {{--</div>--}}

                                {{----}}

                            {{--</form>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('css')
    <!-- cropit -->
    <style>
        .cropit-preview {
            background-color: #f8f8f8;
            background-size: cover;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-top: 7px;
            height: 250px;
            width: 250px;
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
    </style>

@endsection

@section('js')
    <!-- cropit -->
    <script src="{{ url('vendors/cropit/dist/jquery.cropit.js') }}"></script>

    <script>
        $(function() {
            $('.image-editor').cropit();

            $('#image-submit').click(function() {
                // Move cropped image data to hidden input
                var imageData = $('.image-editor').cropit('export');
                $('.hidden-image-data').val(imageData);

                // Print HTTP request params
                var formValue = $(this).serialize();
                $('#result-data').text(formValue);

                // Prevent the form from actually submitting
                return false;
            });
        });
    </script>
@endsection