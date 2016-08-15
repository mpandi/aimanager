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
                        <li><a href="<?php echo base_url(); ?>welcome/users">Users</a></li>
                         <?php } ?>
                        <li><a href="<?php echo base_url(); ?>customers/" class="active">Customers</a></li>
                        <li><a href="<?php echo base_url(); ?>services/">Services</a></li>
                        <li><a href="<?php echo base_url(); ?>welcome/dashboard">My Account</a></li>
                        <li><a href="<?php echo base_url(); ?>welcome/logout">Logout</a></li>
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
            <div class="row margin-bottom-10">
            
                <!--begin col-md-6-->
                <div class="col-md-6 padding-top-10">                                
                    <h3 class="home-title" data-wow-delay="0.5s">Add Customer</h3>                   
                    <p class="home-subtitle wow fadeIn" data-wow-delay="1s">
                       View all customers, their emails, levels and account statuses.<br/>
                        Also add or remove services.
                    </p>
                    <a href="<?php echo base_url(); ?>customers/" class="btn btn-lg btn-white-transparent btn-margin scrool wow fadeIn" data-wow-delay="1.75s">Customers</a>                             
                </div>
                <!--end col-md-6-->
            
                <!--begin col-md-6-->
                <div class="col-md-6 wow slideInRight">
                   <section class="login_content" style="padding:5px;">
                      <div class="eh">Add Customer </div>
                       <?php $attributes = array('class'=>'form-horizontal login_d');
                        echo form_open('customers/add',$attributes);
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
                            <input type="text" class="form-control" name="customer_name" placeholder="Name" required="" value="<?php echo isset($add_name)?$add_name:'';?>"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="address" placeholder="Address" required="" value="<?php echo isset($add_address)?$add_address:'';?>"/>
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" name="billing_contact_name" placeholder="Billing Contact Name" required="" value="<?php echo isset($billing_contact_name)?$billing_contact_name:'';?>"/>
                        </div> 
                        <div class="form-group">
                            <input type="telephone" class="form-control" name="billing_contact_phone" placeholder="Billing Contact Phone" required="" value="<?php echo isset($billing_contact_phone)?$billing_contact_phone:'';?>"/>
                        </div>                       
                       <div class="form-group">
                            <input type="text" class="form-control" name="technical_contact_name" placeholder="Technical Contact Name" required="" value="<?php echo isset($technical_contact_name)?$technical_contact_name:'';?>"/>
                        </div>
                         <div class="form-group">
                            <input type="telephone" class="form-control" name="technical_contact_phone" placeholder="Technical Contact Phone" required="" value="<?php echo isset($technical_contact_phone)?$technical_contact_phone:'';?>"/>
                        </div>
                        <div class="form-group">                       
                            <input type="submit" class="btn btn-success" name="add" value="Add Customer" />
                        </div> 
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