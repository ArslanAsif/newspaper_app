@extends('layouts.app')

@section('content')
	<!-- Page Breadcrumb -->

		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div style="border-top: 2px solid #e8ecf0;"></div>
					<div class="rst-breadcrumb">
						<a href="#"><span>{{ strtoupper($article->category) }} </span></a>
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
						<img src="{{ url(isset($article->picture) ? 'images/news/'.$article->picture : 'images/no-image-available.png') }}" alt="" width=100%/>
						<div class="rst-section-title rst-section-title-box rst-item-content-title">
						<div class="row">
							<h2 class="col-sm-8">{{ $article->title}}</h2>
							<div class="rst-shortmenu col-sm-4">
								<p>
									<!-- <span class="rst-item-likes"><i class="fa fa-heart"></i>10</span>  -->
									
									<span class="rst-item-author"><b>BY</b><a href="{{ ($article->category == 'Opinion') ? url('/category/column/author/'.$article->user->id) : '#' }}">{{$article->user->
									name}}</a></span>
									
									<span class="rst-item-author"><i class="fa fa-clock-o"></i> {{ $article->publish_date }}</span>
									<span class="rst-item-comments"><i class="fa fa-comment"></i>{{ $comment_count }}</span>
									
								</p>
							</div>
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
									<h4>{{ !Auth::guest() ? (Auth::user()->type == 'admin')? $comment_count_admin  : $comment_count  : $comment_count  }} Comments</h4>
								</div>
								<ol class="commentlist">
									@if(!Auth::guest())
									@if(Auth::user()->type == 'admin')
										@foreach($article->comments as $comment)
										<li class="comment">
											<div class="comment-container">
												<div class="comment-avatar">
													<img src="{{ url(isset($comment->user->avatar) ? $comment->user->avatar : 'images/account.png') }}" alt="" />
												</div>
												<div class="comment-data">
													<div class="comment-header">
														<a href="#" class="comment-author">{{ $comment->user->name }}</a>
														<time class="comment-date"><i class="fa fa-clock-o"></i>on {{ $comment->created_at }}</time>
													</div>
													<div class="comment-body">
														<p>{{ $comment->comment }}</p>
														@if(!Auth::guest())
															@if(Auth::user()->type == 'admin' || Auth::user()->id == $comment->user->id)
																<a href="{{ url('/comment/'.$comment->id.'/delete') }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete Comment</a>
																@if($comment->confirmed)
																<a href="{{ url('/comment/'.$comment->id.'/disapprove') }}" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Approved</a>
																@else
																<a href="{{ url('/comment/'.$comment->id.'/approve') }}" class="btn btn-sm btn-primary"><i class="fa fa-close"></i> Not Approved</a>
																@endif
															@endif
														@endif
													</div>
												</div>
											</div>
										</li>
									@endforeach
									@endif

									@else
									@foreach($article->comments as $comment)
										@if($comment->confirmed)
										<li class="comment">
											<div class="comment-container">
												<div class="comment-avatar">
													<img src="{{ url(isset($comment->user->avatar) ? $comment->user->avatar : 'images/account.png') }}" alt="" />
												</div>
												<div class="comment-data">
													<div class="comment-header">
														<a href="#" class="comment-author">{{ $comment->user->name }}</a>
														<time class="comment-date"><i class="fa fa-clock-o"></i>on {{ $comment->created_at }}</time>
													</div>
													<div class="comment-body">
														<p>{{ $comment->comment }}</p>
														@if(!Auth::guest())
															@if(Auth::user()->type == 'admin' || Auth::user()->id == $comment->user->id)
																<a href="{{ url('/comment/delete/'.$comment->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete Comment</a>
															@endif
														@endif
													</div>
												</div>
											</div>
										</li>
										@endif
									@endforeach
									@endif
									
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
										<textarea maxlength="255" class="rst-pageinput" name="comment" type="text" rows="5" placeholder="Add your comment" ></textarea>
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
													<a href="{{ url('/article/'.$article->id) }}"><img width="110px" src="{{ url(isset($article->picture) ? 'images/news/'.$article->picture : 'images/no-image-available.png') }}" alt="" /></a>
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
													<a href="{{ url('/article/'.$article->id) }}"><img width="110px" src="{{ url(isset($article->picture) ? 'images/news/'.$article->picture : 'images/no-image-available.png') }}" alt="" /></a>
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
								<a href="{{ $advertisement->url }}">
									<img width="100%" src="{{ url('images/advertisement/'.$advertisement->image) }}" alt="" />
								</a>
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
								<input name="email" required="required" class="rst-pageinput" type="email" value="Email and hit enter" onblur="if (this.value == '') {this.value = 'Enter Email';}" onclick=" if (this.value == 'Email and hit enter') {this.value = '';}" />	
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