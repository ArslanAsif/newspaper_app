@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                <div class="rst-section-title rst-section-title-box">
                    <h4>{{ $tag_name}} <small>(Tag)</small></h4>
                </div>

                <div class="panel panel-success">
                        <div class="panel-heading">Latest Tags</div>
                        <div class="panel-body">
                        @foreach($tags as $tag)
                            <a href="{{ url('tag/'.$tag->id) }}"><span class="label label-default">{{ $tag->title }}</span></a>
                        @endforeach
                        </div>
                    </div> 


                <div id="rst-popular">
                    <?php $count = 0; ?>
                    @if(isset($articles))
                        @foreach($articles as $article)
                            <?php if($count % 3 == 0) { echo "<div class='row category-row'>"; $count1 = 0; }?>
                            <article class="col-sm-4 col-xs-12">
                                <div class="rst-postpic">
                                    <a href="{{ url('/article/'.$article->id) }}"><img class="img-border" src="{{ isset($article->picture) ? url('images/news/'.$article->picture) : url('images/no-image-available.png') }}" alt="" /></a>
                                    <a class="rst-postpic-cat" href="#"><span>{{ $article->category }}</span><br></a>
                                </div>
                                <div class="rst-postinfo">
                                    <h6><a href="{{ url('/article/'.$article->id) }}">{{ $article->title }}</a></h6>
                                    <time><i class="fa fa-clock-o"></i>{{ $article->publish_date }}</time>
                                    <p>{{ $article->summary }}</p>
                                </div>
                            </article>
                            <?php $count1++; if($count1 % 3 == 0) echo "</div>"; $count++;?>

                        @endforeach
                        <div class="col-xs-12">
                            <nav class="wp-pagenavi">
                                {{ $articles->links() }}
                            </nav>
                        <div class="clear"></div>
                    @endif
                </div>

                                </div>

            <!-- <div class="row">
                <div class="col-xs-12"><br>
                    <nav class="wp-pagenavi">
                        <a class="page-numbers current" href="#">1</a>
                        <a class="page-numbers" href="#">2</a>
                        <a class="page-numbers" href="#">3</a>
                        <a class="page-numbers" href="#">4</a>
                        <a class="page-numbers" href="#">5</a>
                    </nav>
                    <div class="clear"></div>
                </div>
            </div> -->
            <br>
        </div>
    </div>
@endsection
