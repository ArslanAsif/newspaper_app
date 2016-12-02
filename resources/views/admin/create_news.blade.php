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
                            <h2>Create News <small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method=post action="{{ url('admin/news/add') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="type">
                                            <option selected>News</option>
                                            <option>Article</option>
                                            <option>Column</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="title" id="title" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="category">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="summary">Summary <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea id="summary" name="summary" rows="3" required="required" class="form-control col-md-7 col-xs-12"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Priority <small>(Lower is better)</small></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="priority">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5" selected>5</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tags</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="tags_1" name="tags" type="text" class="tags form-control" value="" />
                                        <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Cover Image</label>
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

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Actions</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <div class="">
                                            <label>
                                                <input name="latest" type="checkbox" class="js-switch" /> Show on Latest News bar
                                            </label>
                                        </div>

                                        <div class="">
                                            <label>
                                                <input name="homepage" type="checkbox" class="js-switch" /> Show on Homepage
                                            </label>
                                        </div>

                                        <div class="">
                                            <label>
                                                <input name="spotlight" type="checkbox" class="js-switch" /> Show as spotlight
                                            </label>
                                        </div>

                                        <div class="">
                                            <label>
                                                <input name="publish" type="checkbox" class="js-switch" checked/> Publish
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <h4>Description</h4>
                                @include('admin.includes.text_editor')

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success pull-right">Submit</button>
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
    <!-- bootstrap-wysiwyg -->
    <link href="{{ url('vendors/google-code-prettify/bin/prettify.min.css') }}" rel="stylesheet">

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
            height: 400px;
            width: 660px;
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
    <!-- jQuery Tags Input -->
    <script src="{{ url('vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>

    <!-- jQuery Tags Input -->
    <script>
        function onAddTag(tag) {
            alert("Added a tag: " + tag);
        }

        function onRemoveTag(tag) {
            alert("Removed a tag: " + tag);
        }

        function onChangeTag(input, tag) {
            alert("Changed a tag: " + tag);
        }

        $(document).ready(function() {
            $('#tags_1').tagsInput({
                width: 'auto'
            });
        });
    </script>
    <!-- /jQuery Tags Input -->

    <!-- bootstrap-wysiwyg -->
    <script src="{{ url('vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js') }}"></script>
    <script src="{{ url('vendors/jquery.hotkeys/jquery.hotkeys.js') }}"></script>
    <script src="{{ url('vendors/google-code-prettify/src/prettify.js') }}"></script>

    <!-- bootstrap-wysiwyg -->
    <script>
        $(document).ready(function() {
            function initToolbarBootstrapBindings() {
                var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
                            'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
                            'Times New Roman', 'Verdana'
                        ],
                        fontTarget = $('[title=Font]').siblings('.dropdown-menu');
                $.each(fonts, function(idx, fontName) {
                    fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
                });
                $('a[title]').tooltip({
                    container: 'body'
                });
                $('.dropdown-menu input').click(function() {
                    return false;
                })
                        .change(function() {
                            $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
                        })
                        .keydown('esc', function() {
                            this.value = '';
                            $(this).change();
                        });

                $('[data-role=magic-overlay]').each(function() {
                    var overlay = $(this),
                            target = $(overlay.data('target'));
                    overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
                });

                if ("onwebkitspeechchange" in document.createElement("input")) {
                    var editorOffset = $('#editor').offset();

                    $('.voiceBtn').css('position', 'absolute').offset({
                        top: editorOffset.top,
                        left: editorOffset.left + $('#editor').innerWidth() - 35
                    });
                } else {
                    $('.voiceBtn').hide();
                }
            }

            function showErrorAlert(reason, detail) {
                var msg = '';
                if (reason === 'unsupported-file-type') {
                    msg = "Unsupported format " + detail;
                } else {
                    console.log("error uploading file", reason, detail);
                }
                $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
            }

            initToolbarBootstrapBindings();

            $('#editor').wysiwyg({
                fileUploadError: showErrorAlert
            });

            window.prettyPrint;
            prettyPrint();
        });

        //-- copy html to hidden textarea
        $('#editor').bind("DOMSubtreeModified",function(){
            $('#hidden_descr').html(
                    $("#editor").html()
            );
        });
    </script>
    <!-- /bootstrap-wysiwyg -->

    <!-- Switchery -->
    <script src="{{ url('vendors/switchery/dist/switchery.min.js') }}"></script>

    <!-- cropit -->
    <script src="{{ url('vendors/cropit/dist/jquery.cropit.js') }}"></script>

    <script>
        $(function() {
            $('.image-editor').cropit({
                imageState: {
                    src: 'http://lorempixel.com/500/400/',
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