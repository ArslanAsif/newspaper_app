@extends('layouts.app')

@section('content')
		<!-- Category Page Content -->
		<section id="rst-itemcontent">
			<div class="container">
				<div class="row">
					<div class="col-sm-12" style="padding-bottom: 50px;">
						<div class="rst-section-title rst-section-title-box rst-item-content-title">
							<h2>All About GCC</h2>
						</div>
						<div class="row">
							<article class="col-xs-12">
								<?= $about_gcc ?>
							</article>
						</div>
					</div>
					<!-- End Content Sidebar -->
				</div>
			</div>
		</section>
		<!-- End Category Page Content -->
		
@endsection