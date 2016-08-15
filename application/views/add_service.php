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
                        <li><a href="<?php echo base_url(); ?>customers/">Customers</a></li>
                        <li><a href="<?php echo base_url(); ?>services/" class="active">Services</a></li>
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
                    <h1 class="home-title wow fadeIn">Add Service</h1>                   
                    <p class="home-subtitle wow fadeIn">
                       View all services, their emails, levels and account statuses.<br/>
                        Also add or remove services.
                    </p>
                    <a href="<?php echo base_url(); ?>services/" class="btn btn-lg btn-white-transparent btn-margin scrool wow fadeIn" data-wow-delay="1.75s">View Services</a>                             
                </div>
                <!--end col-md-6-->
            
                <!--begin col-md-6-->
                <div class="col-md-6 wow slideInRight" data-wow-delay="2.25s">
                   <section class="login_content" style="padding:5px;">
                      <div class="eh">Add Service </div>
                       <?php $attributes = array('class'=>'form-horizontal login_d');
                        echo form_open('services/add',$attributes);
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
                            <select name="customer" style="width: 100%;">
                                <option value="" selected="">..Customer..</option>
                                <?php foreach ($customers_data as $value){ ?>
                                <option value="<?php echo $value['id'];?>"><?php echo $value['name_'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="location" placeholder="Location" required="" value="<?php echo isset($add_location)?$add_location:'';?>"/>
                        </div>
                        <div class="form-group">
                            <select name="service_type" style="width: 100%;">
                                <option value="" selected="">..Service Type..</option>
                                <option value="1">Internet</option>
                                <option value="2">VPN</option>
                            </select>
                        </div>
                         <div class="form-group">
                            <select name="billing_cycle" style="width: 100%;">
                                <option value="" selected="">..Billing Cycle..</option>
                                <option value="1">Monthly</option>
                                <option value="4">Quarterly</option>
                                <option value="12">Annual</option>
                            </select>
                        </div>
                       <div class="form-group">
                            <input type="text" class="form-control" name="network" placeholder="Network Details" required="" value="<?php echo isset($add_network)?$add_network:'';?>"/>
                       </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="ips" placeholder="IP Addresses" required="" value="<?php echo isset($add_ips)?$add_ips:'';?>"/>
                        </div>
                         <div class="form-group">
                            <input type="text" class="form-control" name="cpemac" placeholder="CPE MAC" required="" value="<?php echo isset($add_cpemac)?$add_cpemac:'';?>"/>
                        </div>
                         <div class="form-group">
                            <input type="text" class="form-control" name="apconnected" placeholder="AP CONNECTED" required="" value="<?php echo isset($add_apconnected)?$add_apconnected:'';?>"/>
                        </div>
                         <div class="form-group">
                            <input type="text" class="form-control" name="code" placeholder="Code to Execute" value="<?php echo isset($add_code)?$add_code:'';?>"/>
                        </div>
                         <div class="form-group">
                            <input type="text" class="form-control" name="cpegraph" placeholder="CPE Graph" value="<?php echo isset($add_graph)?$add_graph:'';?>"/>
                        </div>
                        <div class="form-group">                       
                            <input type="submit" class="btn btn-success" name="add" value="Add Service" />
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