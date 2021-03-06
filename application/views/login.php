<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($this->session->userdata['logged_in'])){
          redirect("home/dashboard");
        }   
 include 'header.php'; 
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
                        <li><a href="<?php echo base_url(); ?>customers/login">Customer Portal</a></li>
                        <li><a href="<?php echo base_url(); ?>login" class="active">Login</a></li>
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
                                
                    <h1 class="home-title wow fadeIn">Customer Management System</h1>
                    
                    <p class="home-subtitle wow fadeIn" data-wow-delay="1s">
                        Design &amp; style should always work toward making you look<br/>
                        good &amp; feel good - without a lot of efforts - so you can<br/>
                        always get on with the things that truly matter.
                    </p>
                    <a href="#" class="btn scrool wow fadeIn">Discover More!</a>
                                
                </div>
                <!--end col-md-6-->
            
                <!--begin col-md-6-->
                <div class="col-md-6 wow slideInRight" data-wow-delay="2.25s">
                   <section class="login_content" style="padding:5px;">
                      <div class="eh">Login </div>
                       <?php $attributes = array('class'=>'form-horizontal login_d');
                        echo form_open('home/dashboard',$attributes);
                        if(isset($error_message)){
                            echo "<div class='alert alert-danger'>";
                            echo $error_message;
                            echo "</div>";
                            }
                        if(isset($logout_message)){
                            echo "<div class='alert alert-success'>";
                            echo $logout_message;
                            echo "</div>";
                          } ?>
                        <div class="form-group">
                             <label>Username: </label>
                            <input type="text" class="form-control" name="username" placeholder="Username" required="" value=""/>
                        </div>
                       <div class="form-group">
                             <label>Password: </label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required="" value=""/>
                        </div>
                        <div class="form-group">                                          
                              <input type="submit" class="btn btn-success" name="login" value="Log in" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <p class=""><a class="reset_pass" href="forgot">Lost your password?</a></p>
                              
                   </div>
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