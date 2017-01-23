@extends('layouts.app')

@section('content')
	<!-- Page Breadcrumb -->
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="rst-breadcrumb">
						<a href="{{ url('/') }}"><span>{{ strtoupper($article->type) }}</span></a>
						<span>></span>
						@if($article->type == 'news')
							<a href="{{ url('/category/'.$article->type.'/'.$article->category->id) }}"><span>{{ strtoupper($article->category->name) }}</span></a>
						<span>></span>
						@endif
						<a href="#"><span>{{ strtoupper($article->title) }}</span></a>
					</div>
				</div>
			</div>
		</div>
		<!-- End Page Breadcrumb -->
		
		<!-- Category Banner -->
		
		
		<!-- Category Page Content -->
		<section id="rst-itemcontent">
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<img src="{{ url(isset($article->picture) ? 'images/news/'.$article->picture : 'images/cat-01.jpg') }}" alt="" width=100%/>
						<div class="rst-section-title rst-section-title-box rst-item-content-title">
							<h2 class="col-sm-8">{{ $article->title}}</h2>
							<div class="rst-shortmenu col-sm-4">
								<p>
									<!-- <span class="rst-item-likes"><i class="fa fa-heart"></i>10</span>  -->
									
									<span class="rst-item-author"><b>BY</b><a href="{{ ($article->type == 'column') ? url('/category/column/author/'.$article->user->id) : '' }}">{{$article->user->
									name}}</a></span>
									<span class="rst-item-comments"><i class="fa fa-comment"></i>{{ $comment_count }}</span>
								</p>
							</div>
						</div>
						<div class="row">
							<article class="col-xs-12">
								<?php echo $article->description ?>
							</article>
							<!-- End Posts Contents -->
							

							
							<div class="col-xs-12">
								<br>
								<div class="rst-tagsandshare">
									<div class="rst-catlist rst-catlisttags">
										<a>Tags</a>
										@foreach($article->tags as $tag)
										<a href="{{ url('tag/'.$tag->id) }}">
											<span class="label label-default">{{ $tag->title }}</span>
										</a>
										@endforeach
									</div>
									<div class="clear"></div>
								</div>

								<br>
								<div style="border: 1px solid #EBEBEA	; padding: 10px">
									<!-- Go to www.addthis.com/dashboard to customize your tools -->
									<div class="addthis_inline_share_toolbox"></div>
								</div><br>

							</div>
							<!-- End Tags and Share -->
							
							<!-- Comment list -->
							<div class="col-xs-12 rst-content-comment">
								<div class="rst-section-title rst-section-title-box">
									<h4>{{ $comment_count }} Comments</h4>
								</div>
								<ol class="commentlist">
									@foreach($article->comments as $comment)
										<li class="comment">
											<div class="comment-container">
												<div class="comment-avatar">
													<img src="{{ url(isset($comment->user->avatar) ? $comment->user->avatar : 'images/account.jpg') }}" alt="" />
												</div>
												<div class="comment-data">
													<div class="comment-header">
														<a href="#" class="comment-author">{{ $comment->user->name }}</a>
														<time class="comment-date"><i class="fa fa-clock-o"></i>on {{ $comment->created_at }}</time>
													</div>
													<div class="comment-body">
														<p>{{ $comment->comment }}</p>
													</div>
												</div>
											</div>
										</li>
									@endforeach
									
								</ol>
							</div>
							<!-- End comment list -->
							
						</div>

						@if(Auth::guest())
							<p style="text-align: center;">
								<a href="{{ url('/login') }}">Login to post comment</a>
							</p>
			                
			            @elseif(Auth::user()->ban == 1)
			                <p style="color: red; text-align: center;">You are banned from posting comments. For query email at info@xyz.com</p>
			            @else
            				<div class="row">
								<div class="col-xs-12">
									<form action="{{ '/article/'.$article->id.'/comment' }}" method="POST">
										{{ csrf_field() }}
										<textarea class="rst-pageinput" name="comment" type="text" rows="5" placeholder="Add your comment" ></textarea>
										<button class="rst-pagebutton" type="submit" >Submit</button>
									</form>
								</div>
							</div>
							<!-- End Comment Form -->
			            @endif
			            <br>

					</div>
					<div class="col-sm-4">
						<aside class="widget widget_popular">
							<ul>
								<li>
									<a href="#">Related</a>
									<ul>
										@foreach($related as $article)
										<li>
											<article>
												<div class="rst-postpic">
													<a href="{{ url('/article/'.$article->id) }}"><img width="110px" src="{{ url(isset($article->picture) ? 'images/news/'.$article->picture : images/slider/category/pol01.jpg) }}" alt="" /></a>
												</div>
												<div class="rst-postinfo">
													<h6><a href="{{ url('/article/'.$article->id) }}">{{ $article->title }}</a></h6>
													<time><i class="fa fa-clock-o"></i>{{ $article->created_at }}</time>
												</div>
											</article>
										</li>
										@endforeach
									</ul>
								</li>
								<li>
									<a href="#">Latest</a>
									<ul>
										@foreach($latest as $article)
										<li>
											<article>
												<div class="rst-postpic">
													<a href="{{ url('/article/'.$article->id) }}"><img width="110px" src="{{ url(isset($article->picture) ? 'images/news/'.$article->picture : images/slider/category/pol01.jpg) }}" alt="" /></a>
												</div>
												<div class="rst-postinfo">
													<h6><a href="{{ url('/article/'.$article->id) }}">{{ $article->title }}</a></h6>
													<time><i class="fa fa-clock-o"></i>{{ $article->created_at }}</time>
												</div>
											</article>
										</li>
										@endforeach
									</ul>
								</li>
							</ul>
						</aside>
						<!-- end widget popular -->
						
						<aside class="widget widget_adv">
							<h3>Advertisement</h3>
							<div class="rst-hotnews owl-carousel">
								@foreach($advertisements as $advertisement)
                                    <img width="100%" src="{{ url('images/advertisement/'.$advertisement->image) }}" alt="" />
                                @endforeach
							</div>
							<!-- <a href="#"><img src="{{ url('images/ad01.png') }}" alt="" /></a>
							<div class="clear"></div> -->
						</aside>
						<!-- end widget adv -->
						
						<aside class="widget widget_newsletter">
							<h3>Newsletter</h3>
							<form action="{{ url('/subscriber/add') }}" method="POST">
								{{ csrf_field() }}
								<input name="email" class="rst-pageinput" type="text" value="Email and hit enter" onblur="if (this.value == '') {this.value = 'Email and hit enter';}" onclick=" if (this.value == 'Email and hit enter') {this.value = '';}" />	
								<input class="rst-pagebutton" type="submit" value="Subscribe"/>
							</form>
						</aside>
						<!-- end widget newsletter -->
						
					</div>
					<!-- End Content Sidebar -->
				</div>
			</div>
		</section>
		<!-- End Category Page Content -->
		
@endsection