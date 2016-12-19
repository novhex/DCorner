<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="section section-white"  style="margin-top: 100px;">
	        <div class="container">
	        	<div class="row">
	
				<div class="section-title">
				<h1>Search Result(s) </h1>
				</div>
		
			<ul class="grid cs-style-3">

				<?php foreach($search_res as $result):?>
		        	<div class="col-md-4 col-sm-6">
						<figure  style="max-height: 300px !important;">
							<img src="<?php echo $result['display_photo']; ?>" alt="" >
							<figcaption>
								<h3><?php echo $result['firstname']; ?></h3>
								<span><?php echo ucfirst($result['gender']);  ?></span>
								<a href="<?php echo base_url('view-profile/').$result['username']; ?>" style="margin-top: 20px;">View Profile</a>
							</figcaption>
						</figure>
		        	</div>
		        <?php endforeach;?>	

			</ul>

	        	</div>
	        	<div class="text-center">
	        		<?php echo $page_links;?>
	        	</div>
	        </div>
	    </div>
		</div>
	</div>
</div>