<div class="container" style="padding-top: 100px;">
  <h1 class="page-header">Your Profile</h1>
  <div class="row">
    <!-- left column -->
    <div class="col-md-4 col-sm-6 col-xs-12">
      <div class="text-center">

        <form enctype="multipart/form-data" action="<?php echo base_url('update-profile-photo'); ?>" method="POST" accept-charset="utf-8">


        <img id="profile_dp" onclick="$('#dphoto').click();" style="max-width: 250px; max-height: 250px;" src="<?php echo $profile->display_photo; ?>" class="avatar img-responsive  img-thumbnail" alt="<?php echo $this->session->userdata('firstname'); ?> display photo" title="Profile photo of <?php echo $this->session->userdata('firstname'); ?>">


            <div class="text-center" id="dp-help-caption">Click to change profile photo</div>

            <span><input  style="display: none;" type="file" name="dphoto" id="dphoto"></span>

            <button type="submit" id="btn-update-dp" class="btn btn-success"> Update Profile Picture</button>
            <a href="" id="cancel-profiledp-change" class="btn btn-success">Cancel</a>

          </form>


      </div>
    </div>
    <!-- edit form column -->
    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
    
      <?php if($this->session->flashdata('update-profile-ok')!=''){?>
      <div class="col-md-9 personal-info">
        <div class="alert alert-info alert-dismissable">
          <a class="panel-close close" data-dismiss="alert">×</a> 
          <i class="fa fa-coffee"></i>
          <?php echo $this->session->flashdata('update-profile-ok');?>
        </div>

        <?php }?>


      

      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#pinfo"><i class="fa fa-user"></i> Profile Info</a></li>
        <li><a data-toggle="tab" href="#photos"><i class="fa fa-image"></i> Photos</a></li>
        <li><a data-toggle="tab" href="#menu2"><i class="fa fa-info-circle"></i> People Interested At Me</a></li>
      </ul>


      <div class="tab-content">
      <div id="pinfo" class="tab-pane fade in active" style="margin-top: 20px;">


      <form class="form-horizontal" role="form" accept-charset="utf-8" method="POST" action="<?php echo base_url('update-profile'); ?>">
        <div class="form-group">
          <label class="col-lg-3 control-label">First name:</label>
          <div class="col-lg-8">
            <input class="form-control" name="firstname" value="<?php echo $profile->firstname; ?>" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="col-lg-3 control-label">Last name:</label>
          <div class="col-lg-8">
            <input class="form-control" name="lastname" value="<?php echo $profile->lastname; ?>" type="text">
          </div>
        </div>

        
        <div class="form-group">
         <label class="col-lg-3 control-label">Birthdate:</label>
          <div class="col-lg-8">
           <input style="background-color: white;" readonly="true" value="<?php echo $profile->birthdate; ?>" name="bdate" data-format="YYYY-MM-DD" data-template="D MMM YYYY" type="text"  class="form-control" id="bdate"/>
           </div>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">Email:</label>
          <div class="col-lg-8">
            <input class="form-control" name="email"  value="<?php echo $profile->email; ?>" type="text">
          </div>
        </div>
    

        <div class="form-group">
          <label class="col-lg-3 control-label">Gender: </label>
          <div class="col-lg-8">
            <select name="gender" class="form-control">
              

                <?php if($profile->gender=='male'): ?>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="others">Others</option>
                <?php endif; ?>


                <?php if($profile->gender=='female'): ?>
                  <option value="female">Female</option>
                  <option value="male">Male</option>
                  <option value="others">Others</option>
                <?php endif; ?>

              <?php if($profile->gender=='others'): ?>

                   <option value="others">Others</option>
                  <option value="female">Female</option>
                  <option value="male">Male</option>
                <?php endif; ?>

            
            </select>
          </div>
        </div>
          <div class="form-group">
            <label class="col-md-3 control-label"></label>
            <div class="col-md-8">
              <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update Profile</button>
              <span></span>
              
            </div>
          </div>

      </form>
      </div>
      <div id="photos" class="tab-pane fade">
          <div class="row">
            <div class="col-md-12" style="margin-top: 10px;">
              <button class="btn btn-primary"><i class="fa fa-image"></i> Add Photo</button>
            </div>
          </div>
      </div>
      <div id="menu2" class="tab-pane fade">
        <h3>Menu 2</h3>
        <p>Some content in menu 2.</p>
      </div>
    </div>

    </div>
  </div>
</div>