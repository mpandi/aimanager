<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (isset($this->session->userdata['logged_in'])) {
    $username = $this->session->userdata['logged_in']['username'];
    $email = $this->session->userdata['logged_in']['email'];
    $password = $this->session->userdata['logged_in']['password'];
    $level = $this->session->userdata['logged_in']['user_level'];
 include "header.php";
 } 
else {
  redirect('welcome/login', 'refresh');
 }
?>
<body>     
    <!--begin header -->
    <header class="header">
        <!--begin nav -->
        <nav class="navbar navbar-default navbar-fixed-top">
            
            <!--begin container -->
            <div class="container">              
                <div>
                    <ul class="nav navbar-nav navbar-right">			      
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <?php if($level == 1){ ?>
                        <li><a href="users">Users</a></li>
                         <?php } ?>
                        <li><a href="customers">Customers</a></li>
                        <li><a href="<?php echo base_url(); ?>">Services</a></li>
                        <li><a href="dashboard" class="active">My Account</a></li>
                        <li><a href="logout">Logout</a></li>
                    </ul>
                </div>
                <!--end navbar -->
                                    
            </div>
    		<!--end container -->
            
        </nav>
    	<!--end nav -->
        
    </header>
    <!--end header -->
        
    <!--begin home_wrapper -->
    <section id="home_wrapper" class="home-wrapper">

        <!--begin container-->
        <div class="container"> 

            <!--begin row-->
            <div class="row margin-bottom-30">
            
                <!--begin col-md-6-->
                <div class="col-md-6 padding-top-20">
                                
                    <h1 class="home-title wow fadeIn" data-wow-delay="0.5s">Customer Management System</h1>
                    
                    <p class="home-subtitle wow fadeIn" data-wow-delay="1s">
                        Design &amp; style should always work toward making you look<br>
                        good &amp; feel good - without a lot of efforts - so you can<br>
                        always get on with the things that truly matter.
                    </p>
                    <a href="#" class="btn btn-lg btn-white-transparent btn-margin scrool wow fadeIn" data-wow-delay="1.75s">Discover More!</a>
                                
                </div>
                <!--end col-md-6-->
            
                <!--begin col-md-6-->
                <div class="col-md-6 wow slideInRight" data-wow-delay="2.25s">
                   <section class="login_content" style="padding:5px;">
                      <div class="eh">My Account</div>
                       <?php $attributes = array('class'=>'form-horizontal login_d');
                        echo form_open('welcome/update',$attributes); 
                            if(isset($error_message)){
                                    echo "<div class='alert alert-danger'>";
                                    echo $error_message;
                                    echo "</div>";
                                 } 
                                 if(isset($success_message)){
                                    echo "<div class='alert alert-success'>";
                                    echo $success_message;
                                    echo "</div>";
                                 }  ?>
                            <label class="control-label">Email Address</label>
                            <div class="form-group"><input type="email" name="email" value="<?php echo $email; ?>" required="" class="form-control" placeholder="Enter Email"/></div>              
                            <label class="control-label">Username</label>
                            <div class="form-group"><input type="text" name="username" class="form-control" value="<?php echo $username; ?>" readonly=""placeholder="Enter Preferred Username"/></div>
                            <label class="control-label">Password</label>
                            <div class="form-group">
                               <input type="password" name="password" class="form-control" value="<?php echo $password;?>" required="" placeholder="Choose a Password"/></div>
                           <div class="form-group"><input type="submit" name="update" class="btn btn-info" value="Update"/></div>
                   <?php echo form_close(); ?>
                </section>
                </div>
                <!--end col-md-6-->    
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
<?php include 'footer.php'; ?>