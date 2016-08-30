<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($this->session->userdata['customer_logged_in'])){
          redirect("customers/dashboard");
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
                        <li><a href="<?php echo base_url(); ?>customers/login" class="active">Customer Portal</a></li>
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
        <div class="container-fluid"> 
            <div class="row-fluid">
                <div class="span6 offset3">
                   <section class="login_content" style="padding:5px;">
                      <div class="eh">Login </div>
                       <?php $attributes = array('class'=>'form-horizontal login_d');
                        echo form_open('customers/dashboard',$attributes);
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