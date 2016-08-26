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
  redirect('login/', 'refresh');
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
                        <li><a href="<?php echo base_url(); ?>users/">Users</a></li>
                        <li><a href="<?php echo base_url(); ?>emailsForm/" class="active">Email Form</a></li>
                         <?php } ?>
                        <li><a href="<?php echo base_url(); ?>customers/">Customers</a></li>
                        <li><a href="<?php echo base_url(); ?>services/">Services</a></li>
                        <li><a href="<?php echo base_url(); ?>home/dashboard">My Account</a></li>
                        <li><a href="<?php echo base_url(); ?>logout/">Logout</a></li>
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
                    <h1 class="home-title wow fadeIn" data-wow-delay="0.5s">Add Email Data</h1>                   
                    <p class="home-subtitle wow fadeIn" data-wow-delay="1s">
                       
                    </p>
                    <a href="<?php echo base_url(); ?>emailsForm/" class="btn">View Emails Data</a>                             
                </div>
                <!--end col-md-6-->
            
                <!--begin col-md-6-->
                <div class="col-md-6 wow slideInRight">
                   <section class="login_content" style="padding:5px;">
                      <div class="eh">Add Email Data </div>
                       <?php $attributes = array('class'=>'form-horizontal login_d');
                        echo form_open('emailsForm/add',$attributes);
                        if(isset($error_message)){
                            echo "<div class='alert alert-danger'>";
                            echo $error_message;
                            echo "</div>";
                            }
                        if(isset($success_message)){
                            echo "<div class='alert alert-success'>";
                            echo $success_message;
                            echo "</div>";
                          } 
                          echo validation_errors();?>
                        <div class="form-group">
                         <label>Billing Expiry: </label>
                            <textarea class="form-control" name="billing_expiry" required="" style="width: 100%; height: 100px;"><?php echo isset($billing_expiry)?$billing_expiry:'';?></textarea>
                        </div>
                        <div class="form-group">
                             <label>End of Billing Expiry: </label>
                            <textarea class="form-control" name="end_billing_expiry" required="" style="width: 100%; height: 100px;"><?php echo isset($end_billing_expiry)?$end_billing_expiry:'';?></textarea>
                        </div>
                        <div class="form-group">
                             <label>End of Grace Period: </label>
                            <textarea class="form-control" name="end_grace_period" required="" style="width: 100%; height: 100px;"><?php echo isset($end_grace_period)?$end_grace_period:'';?></textarea>
                        </div>                 
                        <div class="form-group">                       
                              <input type="submit" class="btn btn-success" name="add" value="Update" />
                        </div> 
                  
                   <?php echo form_close(); ?>
                    </div>
                </section>
                </div>
                <!--end col-md-6-->    
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
<?php include 'footer.php'; ?>