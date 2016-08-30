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
                        <li><a href="<?php echo base_url(); ?>emailsForm/">Email Form</a></li>
                        <?php } ?>
                        <li><a href="<?php echo base_url(); ?>customers/" class="active">Customers</a></li>
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
        <div class="container-fluid"> 

            <!--begin row-->
            <div class="row-fluid login_content">
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
                        <div class="span4 offset2">
                        <div class="form-group" style="padding-top: 10px;">
                            <label>Customer Name: </label>
                            <input type="text" class="form-control" name="customer_name" placeholder="Name" required="" value="<?php echo isset($add_name)?$add_name:'';?>"/>
                        </div>
                       <div class="form-group">
                            <label>Billing Contact Email: </label>
                            <input type="email" class="form-control" name="billing_email" placeholder="Email" required="" value="<?php echo isset($add_email)?$add_email:'';?>"/>
                        </div>
                         <div class="form-group">
                            <label>Technical Contact Email: </label>
                            <input type="email" class="form-control" name="technical_email" placeholder="Email" required="" value="<?php echo isset($add_temail)?$add_temail:'';?>"/>
                        </div>
                        <div class="form-group">
                           <label>Username: </label>
                           <input type="text" class="form-control" name="username" placeholder="Username" required="" value="<?php echo isset($add_username)?$add_username:'';?>"/>
                        </div>
                        <div class="form-group">
                           <label>Password: </label>
                           <input type="text" class="form-control" name="password" placeholder="Password" required="" value="<?php echo isset($add_password)?$add_password:'';?>"/>
                        </div>
                       </div>
                       <div class="span4">
                        <div class="form-group" style="padding-top: 10px;">
                            <label>Customer Address: </label>
                            <input type="text" class="form-control" name="address" placeholder="Address" required="" value="<?php echo isset($add_address)?$add_address:'';?>"/>
                        </div>
                        
                        <div class="form-group" style="padding-top: 10px;">
                            <label>Billing Contact Name: </label>
                            <input type="text" class="form-control" name="billing_contact_name" placeholder="Billing Contact Name" required="" value="<?php echo isset($billing_contact_name)?$billing_contact_name:'';?>"/>
                        </div> 
                        <div class="form-group" style="padding-top: 10px;">
                            <label>Billing Contact Phone: </label>
                            <input type="telephone" class="form-control" name="billing_contact_phone" placeholder="Billing Contact Phone" required="" value="<?php echo isset($billing_contact_phone)?$billing_contact_phone:'';?>"/>
                        </div>                       
                       <div class="form-group" style="padding-top: 10px;">
                            <label>Technical Contact Name: </label>
                            <input type="text" class="form-control" name="technical_contact_name" placeholder="Technical Contact Name" required="" value="<?php echo isset($technical_contact_name)?$technical_contact_name:'';?>"/>
                        </div>
                         <div class="form-group" style="padding-top: 10px;">
                          <label>Technical Contact Phone: </label>
                            <input type="telephone" class="form-control" name="technical_contact_phone" placeholder="Technical Contact Phone" required="" value="<?php echo isset($technical_contact_phone)?$technical_contact_phone:'';?>"/>
                        </div>
                        <div class="form-group">                       
                            <input type="submit" class="btn btn-success" name="add" value="Add Customer" />
                        </div> 
                     </div>
                   <?php echo form_close(); ?> 
                </div>
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
<?php include 'footer.php'; ?>