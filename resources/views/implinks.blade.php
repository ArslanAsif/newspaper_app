@extends('layouts.app')

@section('content')
		
		<!-- Category Page Content -->
		<section id="rst-itemcontent">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="rst-section-title rst-section-title-box rst-item-content-title">
							<h2>Important Links</h2>
						</div>
						<div class="row">
							<article class="col-xs-12">
								<?= isset($links) ? $links->description : '' ?>
								<br><br>
							</article>

						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Category Page Content -->
		
@endsection