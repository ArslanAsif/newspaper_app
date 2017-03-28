@extends('layouts.app')

@section('content')
		<!-- Category Page Content -->
		<section id="rst-itemcontent">
			<div class="container">
				<div class="row">
					<div class="col-sm-8 col-xs-12">
						<div class="rst-section-title rst-section-title-box rst-item-content-title">
							<h2>About Us</h2>
						</div>
						<div class="row">
							<article class="col-xs-12">
								<?= $about_us ?>
							</article>
						</div>
					</div>
					<div class="col-sm-4 col-xs-12">
						<div class="rst-section-title rst-section-title-box rst-item-content-title">
							<h2>Contact Us</h2>
							<?= $contact_us ?>
							
						</div>
						
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