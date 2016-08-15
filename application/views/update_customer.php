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
            <div class="row margin-bottom-30">
            
                <!--begin col-md-6-->
                <div class="col-md-6 padding-top-20">                                
                    <h3 class="home-title">Update Customer</h3>                   
                    <p class="home-subtitle wow fadeIn">
                       View all customers, their emails, levels and account statuses.<br/>
                        Also add or remove services.
                    </p>
                    <a href="<?php echo base_url(); ?>customers/add_customer" class="btn scrool wow fadeIn">Add Customer</a>                             
                </div>
                <!--end col-md-6-->
            
                <!--begin col-md-6-->
                <div class="col-md-6 wow slideInRight">
                   <section class="login_content" style="padding:5px;">
                      <div class="eh">Update: <span style="color: black;"><?php echo $customer_data[0]['name_'];?></span> </div>
                       <?php $attributes = array('class'=>'form-horizontal login_d');
                        echo form_open('customers/update',$attributes);
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
                            <label>Customer Name: </label>
                            <input type="hidden" name="customer_id" value="<?php echo $customer_data[0]['id'];?>"/>
                            <input type="text" class="form-control" name="customer_name" placeholder="Name" required="" value="<?php echo isset($add_name)?$add_name:$customer_data[0]['name_'];?>"/>
                        </div>
                        <div class="form-group">
                           <label>Customer Address: </label>
                           <input type="text" class="form-control" name="address" placeholder="Address" required="" value="<?php echo isset($add_address)?$add_address:$customer_data[0]['address'];?>"/>
                        </div>
                        <div class="form-group">
                        <label>Billing Contact Name: </label>
                        <input type="text" class="form-control" name="billing_contact_name" placeholder="Billing Contact Name" required="" value="<?php echo isset($billing_contact_name)?$billing_contact_name:$customer_data[0]['billing_contact_name'];?>"/>
                        </div> 
                        <div class="form-group">
                         <label>Billing Contact Phone: </label>
                         <input type="telephone" class="form-control" name="billing_contact_phone" placeholder="Billing Contact Phone" required="" value="<?php echo isset($billing_contact_phone)?$billing_contact_phone:$customer_data[0]['billing_contact_phone'];?>"/>
                        </div>                           
                       <div class="form-group">
                        <label>Technical Contact Name: </label>
                        <input type="text" class="form-control" name="technical_contact_name" placeholder="Technical Contact Name" required="" value="<?php echo isset($technical_contact_name)?$technical_contact_name:$customer_data[0]['technical_contact_name'];?>"/>
                        </div>
                        <div class="form-group">
                         <label>Technical Contact Phone: </label>
                         <input type="telephone" class="form-control" name="technical_contact_phone" placeholder="Technical Contact Phone" required="" value="<?php echo isset($technical_contact_phone)?$technical_contact_phone:$customer_data[0]['technical_contact_phone'];?>"/>
                        </div>
                        <div class="form-group">                       
                        <input type="submit" class="btn btn-success" name="update" value="Update Customer" />
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