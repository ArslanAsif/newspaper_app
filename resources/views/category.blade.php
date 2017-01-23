@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="rst-section-title rst-section-title-box">
                    <h4>{{ $category }}</h4>
                    <div class="rst-shortmenu">
                        <form action="#">
                            <select name="rst-catshortselect" id="rst-catshortselect" onchange="location = this.value;"> 
                                @if(isset($authors))
                                    <option value="{{ url('category/column') }}">All</option>
                                    @foreach($authors as $author)
                                        <option {{ isset($user) ? $user->id == $author->user_id ? 'selected' : '' : '' }} value="{{ url('category/column/author/'.$author->user_id) }}">{{ $author->user->name }}</option>
                                    @endforeach
                                @elseif(isset($subcategories))
                                    @foreach($subcategories as $subcategory)
                                        <option {{ isset($subcat) ? $category == $subcategory->name ? 'selected' : '' : '' }} value="{{ url('category/news/'.$subcategory->id) }}">{{ $subcategory->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </form>
                    </div>
                </div>

                <div id="rst-popular">
                    <?php $count = 0; ?>
                    @if(isset($articles))
                        @foreach($articles as $article)
                            @if($count % 3 == 0)
                                <div class='row category-row'>
                                <?php $count1 = 0; ?>
                            @endif
                            <article class="col-sm-4 col-xs-12">
                                <div class="rst-postpic">
                                    <a href="{{ url('/article/'.$article->id) }}"><img class="img-border" src="{{ isset($article->picture) ? url('images/news/'.$article->picture) : 'images/slider/category/po01.jpg' }}" alt="" /></a>

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
