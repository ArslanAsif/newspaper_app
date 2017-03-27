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
                            <h2>{{ isset($news) ? 'Edit News': 'Create News'}} <small></small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li class="pull-right"><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />

                            @include('admin.includes.errors')

                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method=post action="{{ isset($news) ?  url('admin/news/edit/'.$news->id): url('news/add') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Country<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="country" id="country">
                                            <option disabled="disabled" selected>-- Select --</option>
                                            <option {{ isset($news) ? ($news->country == "Bahrain") ? 'selected': '': ''}} {{isset($errors) ? old('country') == 'Bahrain' ? 'selected' : '' : ''}}>Bahrain</option>
                                            <option {{ isset($news) ? ($news->country == "Kuwait") ? 'selected': '': '' }} {{isset($errors) ? old('country') == 'Kuwait' ? 'selected' : '' : ''}}>Kuwait</option>
                                            <option {{ isset($news) ? ($news->country == "Oman") ? 'selected': '': '' }} {{isset($errors) ? old('country') == 'Oman' ? 'selected' : '' : ''}}>Oman</option>
                                            <option {{ isset($news) ? ($news->country == "Qatar") ? 'selected': '': '' }} {{isset($errors) ? old('country') == 'Qatar' ? 'selected' : '' : ''}}>Qatar</option>
                                            <option {{ isset($news) ? ($news->country == "Saudi Arabia") ? 'selected': '': '' }} {{isset($errors) ? old('country') == 'Saudi Arabia' ? 'selected' : '' : ''}}>Saudi Arabia</option>
                                            <option {{ isset($news) ? ($news->country == "UAE") ? 'selected': '': '' }} {{isset($errors) ? old('country') == 'UAE' ? 'selected' : '' : ''}}>UAE</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="title">Title <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="title" id="title" value="{{ isset($news) ? $news->title: '' }}{{ isset($errors) ? old('title') : '' }}" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group" id='category-div'>
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Category<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="category" id="category">
                                            <option disabled="disabled" selected>-- Select --</option>
                                            <option {{ isset($news) ? ($news->category == "GCC") ? 'selected': '': '' }} {{isset($errors) ? old('category') == 'GCC' ? 'selected' : '' : ''}}>GCC</option>
                                            <option {{ isset($news) ? ($news->category == "World") ? 'selected': '': '' }} {{isset($errors) ? old('category') == 'World' ? 'selected' : '' : ''}}>World</option>
                                            <option {{ isset($news) ? ($news->category == "Business") ? 'selected': '': '' }} {{isset($errors) ? old('category') == 'Business' ? 'selected' : '' : ''}}>Business</option>
                                            <option {{ isset($news) ? ($news->category == "Weather") ? 'selected': '': '' }} {{isset($errors) ? old('category') == 'Weather' ? 'selected' : '' : ''}}>Weather</option>
                                            <option {{ isset($news) ? ($news->category == "Sports") ? 'selected': '': '' }} {{isset($errors) ? old('category') == 'Sports' ? 'selected' : '' : ''}}>Sports</option>
                                            <option {{ isset($news) ? ($news->category == "Lifestyle") ? 'selected': '': '' }} {{isset($errors) ? old('category') == 'Lifestyle' ? 'selected' : '' : ''}}>Lifestyle</option>
                                            <option {{ isset($news) ? ($news->category == "Opinion") ? 'selected': '': '' }} {{isset($errors) ? old('category') == 'Opinion' ? 'selected' : '' : ''}}>Opinion</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="summary">Summary <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea maxlength="150" id="summary" name="summary" rows="3" required="required" class="form-control col-md-7 col-xs-12">{{ isset($news) ? $news->summary: '' }}{{ isset($errors) ? old('summary') : '' }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group" id="priority-div">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Priority <small>(Lower is better)</small></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="priority">
                                            <option {{ isset($news) ? ($news->priority == 5) ? 'selected' : '' : '' }} {{ isset($errors) ? (old('priority') == 5) ? 'selected': '': '' }} value="5">5</option>

                                            <option {{ isset($news) ? ($news->priority == 4) ? 'selected' : '' : '' }} {{ isset($errors) ? (old('priority') == 4) ? 'selected': '' : '' }} value="4">4</option>

                                            <option {{ isset($news) ? ($news->priority == 3) ? 'selected' : '' : '' }} {{ isset($errors) ? (old('priority') == 3) ? 'selected': '': '' }} value="3">3</option>

                                            <option {{ isset($news) ? ($news->priority == 2) ? 'selected' : '' : '' }} {{ isset($errors) ? (old('priority') == 2) ? 'selected': '': '' }} value="2">2</option>

                                            <option {{ isset($news) ? ($news->priority == 1) ? 'selected' : '' : '' }} {{ isset($errors) ? (old('priority') == 1) ? 'selected': '' : '' }} value="1">1</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tags</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="tags_1" name="tags" type="text" class="tags form-control" value="{{ isset($tags) ? $tags: '' }}{{isset($errors) ? old('tags') : ''}}" />
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

                                        <input type="hidden" name="image-data" class="hidden-image-data" value="{{ isset($errors) ? old('image-data') : ''}}" />
                                        <span class="pull-right">
                                            <a class="btn btn-default select-image-btn">Select new image</a>
                                        <a class="btn btn-success export">Upload</a>
                                        </span>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Actions</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <div class="" id="latest-switch">
                                            <label>
                                                <input name="latest" type="checkbox" class="js-switch" {{ isset($news) ? ($news->latest == 1) ? 'checked': '': '' }} {{isset($errors) ? old('latest') ? 'checked' : '' : ''}} /> Show on Latest News bar
                                            </label>
                                        </div>

                                        <div class="" id="homepage-switch">
                                            <label>
                                                <input name="homepage" type="checkbox" class="js-switch" {{ isset($news) ? ($news->homepage == 1) ? 'checked': '': '' }} {{isset($errors) ? old('homepage') ? 'checked' : '' : ''}} /> Show on Homepage
                                            </label>
                                        </div>

                                        <div class="" id="spotlight-switch">
                                            <label>
                                                <input name="spotlight" type="checkbox" class="js-switch" {{ isset($news) ? ($news->spotlight == 1) ? 'checked': '': '' }} {{isset($errors) ? old('spotlight') ? 'checked' : '' : ''}} /> Show as spotlight
                                            </label>
                                        </div>

                                        <div class="" id="publish-switch">
                                            <label>
                                                <input name="publish" type="checkbox" class="js-switch" {{ isset($news) ? ($news->publish_date != null) ? 'checked': '' : 'checked' }} {{isset($errors) ? old('publish') ? 'checked' : '' : ''}} /> Publish
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <h4>Description</h4>
                                @include('admin.includes.text_editor')
                                <div id="editor" class="editor-wrapper"><?php echo (isset($news) ? $news->description : ''); echo (isset($errors) ? old('descr') : '') ?></div>
                                <textarea name="descr" id="hidden_descr" style="display:none;"></textarea>

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
                smallImage: 'allow',
                imageState: {
                    src: '{{ isset($news) ? url('images/news/'.$news->picture) : '' }}{{ isset($errors) ? old('image-data') : ''}}',
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

    <!-- hide category dropdown if type != news -->
    <script>
        $('#category').on('change', function() {
            if($(this).val() == 'Opinion')
            {
                $('#latest-switch').hide();
                $('#homepage-switch').hide();
                $('#spotlight-switch').hide();
            }
            else
            {
                $('#latest-switch').show();
                $('#homepage-switch').show();
                $('#spotlight-switch').show();
            }
        });
    </script>

    <!--Toastr notification-->
    <script src="{{ url('toastr/toastr.min.js') }}"></script>

    <script>
        @if(Session::has('message'))
            toastr["success"]("Successfully Submitted");
        @endif
    </script>
@endsection