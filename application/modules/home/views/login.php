<div id="bg">
  <img src="<?php echo base_url('assets/images/1.jpg'); ?>" alt="">
</div>

<div class="container" style="margin-top: 155px;">
	<div class="row">
		<div class="col-md-4 col-md-push-4">
		<form action="" method="POST" accept-charset="utf-8">
			<h1 style="color:white;"> Login </h1>
			<div class="col-md-11">
			<?php 
				echo $this->session->flashdata('login_error')!='' ? "<div style='color:white;'>".$this->session->flashdata('login_error')."</div>" : '' ;  

				echo "<div style='color:white;'>".validation_errors()."</div>";
			?>
			</div>
			<div class="col-md-12">
				<label style="color:white;">Email Address</label>
				<input type="email" name="email" class="form-control" value="" />
			</div>

			<div class="col-md-12">
				<label style="color:white;">Password</label>
				<input type="password" name="password" class="form-control" value="" />
			</div>

			<div class="col-md-11">
				<button type="submit" class="btn btn-primary" style="margin-top: 10px; margin-bottom: 50px;"><i class="fa fa-lock"></i> Continue</button>
				<a href=""  class="btn-primary btn" style="margin-top:-40px;"><i class="fa fa-info-circle"></i> Forgot Password</a>
			</div>

			</form>

		</div>
	</div>
</div>