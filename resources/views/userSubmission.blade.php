@extends('layouts.form')

@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Create News/Article/Column<small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" >
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Country<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="country" id="country">
                                            <option disabled="disabled" selected>-- Select --</option>
                                            <option>Bahrain</option>
                                            <option>Kuwait</option>
                                            <option>Oman</option>
                                            <option>Qatar</option>
                                            <option>Saudi Arabia</option>
                                            <option>UAE</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="title" id="title" value="" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group" id='category-div'>
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Category<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="category" id="category">
                                            <option disabled="disabled" selected>-- Select --</option>
                                            <option>GCC</option>
                                            <option>World</option>
                                            <option>Business</option>
                                            <option>Weather</option>
                                            <option>Sports</option>
                                            <option>Lifestyle</option>
                                            <option>Opinion</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="summary">Summary <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea maxlength="150" id="summary" name="summary" rows="3" required="required" class="form-control col-md-7 col-xs-12"></textarea>
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

                                        <input type="hidden" name="image_data" id="hidden_img" class="hidden-image-data" />
                                        <span class="pull-right">
                                            <a class="btn btn-default select-image-btn">Select new image</a>
                                        <a class="btn btn-success export">Upload</a>
                                        </span>

                                    </div>
                                </div>


                                <h4>Description</h4>
                                @include('admin.includes.text_editor')
                                <div id="editor" class="editor-wrapper"><?php echo (isset($news) ? $news->description : '') ?></div>
                                <textarea name="descr" id="hidden_descr" style="display:none;"></textarea>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <a onclick="formSubmit()" class="btn btn-success pull-right">Submit</a>
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


    <!--Toastr notification-->
    <link rel="stylesheet" href="{{ url('toastr/toastr.min.css') }}">

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
                smallImage: 'allow',
                imageState: {
                    src: '{{ isset($news) ? url('images/news/'.$news->picture) : '' }}',
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

    <!--Toastr notification-->
    <script src="{{ url('toastr/toastr.min.js') }}"></script>

    <script>
    function formSubmit()
    {
        $csrf_token = '{{ csrf_token() }}';
        $country = $('#country option:selected').text();
        $title = $('#title').val();
        $category = $('#category option:selected').text();
        $summary = $('#summary').val();
        $tags = $('#tags_1').val();
        $image_data = $('#hidden_img').val();
        $descr = $('#hidden_descr').val();

        console.log(
            //$csrf_token
            //$country
            //$title
            //$category
            //$summary
            //$tags
            //$image_data
            //$descr
            );


        $.ajax({
            method: 'POST',
            url: "{{ url('news/add') }}",
            data: {
                _token: $csrf_token,
                country: $country,
                title: $title,
                category: $category,
                summary: $summary,
                tags: $tags,
                image_data: $image_data,
                descr: $descr,
            },
            success: function() {
                toastr["success"]("Successfully Submitted");
            }
        })
        .fail(function() {
            toastr["error"]("An error occured!");
        });
    }
    </script>
@endsection