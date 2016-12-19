    <header class="navbar navbar-default navbar-fixed-top" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url('index.html');?>"><i class="fa fa-heartbeat" style="color:pink;"></i> TheDatingCorner</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">

                    <form class="navbar-form navbar-right" action="<?php  echo base_url('search-person.html');?>" method="GET" accept-charset="utf-8">
                        <input type="text" class="form-control" placeholder="Search Name" name="search" required="" />
                        <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </form>

                    <li class="<?php echo uri_string()=='index.html' || uri_string()=='' ? 'active' : '';   ?>"><a href="<?php echo base_url('index.html');?>"><i class="fa fa-home"></i> Home</a></li>

                    <?php if($this->session->userdata('id')!=''){?>

                       <?php }else{?>
                        <li class="<?php echo uri_string()=='login.html' ? 'active' : '';   ?>"><a href="<?php echo base_url('login.html');?>"><i class="fa fa-lock"></i> Login</a></li>
                       <li class="<?php echo uri_string()=='register.html' ? 'active' : '';   ?>"><a href="<?php echo base_url('register.html');?>"><i class="fa fa-users"></i> Sign Up</a></li>

                   <?php }?>

                   <?php
                   if($this->session->userdata('id')!=''){?>
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-heart"></i> Hello <?php echo isset($profile->firstname) ? $profile->firstname : $this->session->userdata('firstname'); ?> <i class="icon-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url('profile.html'); ?>"><i class="fa fa-user"></i> View Profile</a></li>
                        
                            <li><a href="<?php echo base_url('logout'); ?>"><i class="fa fa-ban"></i> Logout</a></li>
                        </ul>
                    </li>

                   <?php }?>
                </ul>
            </div>
        </div>
    </header><!--/header-->