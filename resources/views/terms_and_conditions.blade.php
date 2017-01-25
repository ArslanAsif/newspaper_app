@extends('layouts.app')

@section('content')
	<!-- Page Breadcrumb -->
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="rst-breadcrumb">
						<a href="{{ url('/') }}"><span>About</span></a>
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
					<div class="col-sm-12">
						<div class="rst-section-title rst-section-title-box rst-item-content-title">
							<h2>Terms And Conditions</h2>
						</div>
						<div class="row">
							<article class="col-xs-12">
								<?= $terms ?>
								<br><br>
							</article>

						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Category Page Content -->
		
@endsection