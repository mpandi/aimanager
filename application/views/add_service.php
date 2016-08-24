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
                         <?php } ?>
                        <li><a href="<?php echo base_url(); ?>customers/">Customers</a></li>
                        <li><a href="<?php echo base_url(); ?>services/" class="active">Services</a></li>
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
                <div class="span10 offset2">
                   <section class="login_content" style="padding:5px;">
                      <div class="eh">Add Service </div>
                      <div class="row-fluid">
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
                      <div class="span5">                    
                        <div class="form-group" style="padding-top: 5px;">
                         <label>Customer Name: </label>
                            <select name="customer" style="width: 100%;">
                                <option value="" selected="">..Customer..</option>
                                <?php foreach ($customers_data as $value){ ?>
                                <option value="<?php echo $value['id'];?>"><?php echo $value['name_'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group" style="padding-top: 5px;">
                          <label>Service Location: </label>
                            <input type="text" class="form-control" name="location" placeholder="Location" required="" value="<?php echo isset($add_location)?$add_location:'';?>"/>
                        </div>
                        <div class="form-group" style="padding-top: 5px;">
                         <label>Service Type: </label>
                            <select name="service_type" style="width: 100%;">
                                <option value="" selected="">..Service Type..</option>
                                <option value="1">Internet</option>
                                <option value="2">VPN</option>
                            </select>
                        </div>
                         <div class="form-group" style="padding-top: 5px;">
                            <label>Billing Cycle: </label>
                            <select name="billing_cycle" style="width: 100%;">
                                <option value="" selected="">..Billing Cycle..</option>
                                <option value="1">Monthly</option>
                                <option value="3">Quarterly</option>
                                <option value="12">Annual</option>
                            </select>
                         </div>
                         <div class="form-group" style="padding-top: 5px;">
                            <label>Billing Start Date: </label>
                            <input type="text" class="form-control" name="startdate" id="datepicker" placeholder="Billing Start Date" required="" value="<?php echo isset($add_billing_start_date)?$add_billing_start_date:'';?>"/>
                         </div>
                         <div class="form-group" style="padding-top: 5px;">
                           <label>Billing Expiry Date: </label>
                            <input type="text" class="form-control" name="expirydate" id="datepicker2" placeholder="Billing Expiry Date" required="" value="<?php echo isset($add_billing_expiry_date)?$add_billing_expiry_date:'';?>"/>
                         </div>
                      </div>
                      <div class="span6 offset1">
                        <div class="form-group" style="padding-top: 5px;">
                            <label>IP Addresses: </label>
                            <input type="text" class="form-control" name="ips" placeholder="IP Addresses" required="" value="<?php echo isset($add_ips)?$add_ips:'';?>"/>
                        </div>
                         <div class="form-group" style="padding-top: 5px;">
                          <label>CPE MAC: </label>
                            <input type="text" class="form-control" name="cpemac" placeholder="CPE MAC" required="" value="<?php echo isset($add_cpemac)?$add_cpemac:'';?>"/>
                        </div>
                         <div class="form-group" style="padding-top: 5px;">
                            <label>AP CONNECTED: </label>
                            <input type="text" class="form-control" name="apconnected" placeholder="AP CONNECTED" required="" value="<?php echo isset($add_apconnected)?$add_apconnected:'';?>"/>
                        </div>
                         <div class="form-group" style="padding-top: 5px;">
                            <label>Graph Details: </label>
                            <input type="text" class="form-control" name="cpegraph" placeholder="CPE Graph" value="<?php echo isset($add_graph)?$add_graph:'';?>"/>
                        </div>
                        <div class="form-group">                       
                            <input type="submit" class="btn btn-success" name="add" value="Add Service" />
                        </div> 
                   </div>              
                   <?php echo form_close(); ?>
                    </div>
                    </section>  
                   </div>
                 </div>             
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
<?php include 'footer.php'; ?>