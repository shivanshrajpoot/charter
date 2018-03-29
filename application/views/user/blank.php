<div class="gtco-loader"></div>
	
<div id="page">


<!-- <div class="page-inner"> -->
<header id="gtco-header" class="gtco-cover gtco-cover-sm" role="banner" style="background-image: url(images/img_bg_3.jpg)">
	<div class="overlay"></div>
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-12 col-md-offset-0 text-left">
				<div class="row row-mt-15em">

					<div class="col-md-7 mt-text animate-box" data-animate-effect="fadeInUp">
						<?php $data = @$this->session->flashdata('success_page'); ?>
						<h1><?php echo @$data['title']; ?></h1> 
					</div>
				</div>
				
			</div>
		</div>
	</div>
</header>


<div class="gtco-section border-bottom">
	<div class="gtco-container">
		<div class="row">
			<div class="col-md-12">
				<h6 class="text-<?php echo @$data['type'] ?>"><?php echo @$data['message']; ?></h6>
			</div>
		</div>
	</div>
</div>