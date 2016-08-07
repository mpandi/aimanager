<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($this->session->userdata['logged_in'])){
          $this->load->view('dashboard');
        }   
 include 'header.php'; 
?>
<body>
    
    <!--begin loader -->
    <div id="loader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--end loader -->
    
    <!--begin header -->
    <header class="header">
        <!--begin nav -->
        <nav class="navbar navbar-default navbar-fixed-top">
            
            <!--begin container -->
            <div class="container">              
                <div>
                    <ul class="nav navbar-nav navbar-right">			      
                        <li><a href="index">Home</a></li>
                        <li><a href="login" class="active">Login</a></li>
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
                        Design &amp; style should always work toward making you look<br/>
                        good &amp; feel good - without a lot of efforts - so you can<br/>
                        always get on with the things that truly matter.
                    </p>
                    <a href="#" class="btn btn-lg btn-white-transparent btn-margin scrool wow fadeIn" data-wow-delay="1.75s">Discover More!</a>
                                
                </div>
                <!--end col-md-6-->
            
                <!--begin col-md-6-->
                <div class="col-md-6 wow slideInRight" data-wow-delay="2.25s">
                   <section class="login_content" style="padding:5px;">
                      <div class="eh">Login </div>
                       <?php $attributes = array('class'=>'form-horizontal login_d');
                        echo form_open('welcome/dashboard',$attributes);
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
                            <input type="text" class="form-control" name="username" placeholder="Username" required="" value=""/>
                        </div>
                       <div class="form-group">
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