<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (isset($this->session->userdata['logged_in'])) {
    $username = $this->session->userdata['logged_in']['username'];
    $email = $this->session->userdata['logged_in']['email'];
    $password = $this->session->userdata['logged_in']['password'];
    $level = $this->session->userdata['logged_in']['user_level'];
 include "header.php";
 }
elseif($level != 1){
    redirect('services/', 'refresh');
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
            <div class="container-fluid">              
                <div>
                    <ul class="nav navbar-nav navbar-right">                  
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <?php if($level == 1){ ?>
                        <li><a href="<?php echo base_url(); ?>users/">Users</a></li>
                        <li><a href="<?php echo base_url(); ?>emailsForm/">Email Form</a></li>
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
                      <div class="eh">Update Service </div>
                      <div class="row-fluid">
                       <?php $attributes = array('class'=>'form-horizontal login_d');
                        echo form_open('services/update',$attributes);
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
                         <div class="form-group">
                         <label>Customer Name: </label>
                            <input type="hidden" name="service_id" value="<?php echo $service_data[0]['id'];?>"/>
                            <select name="customer" style="width: 100%;">
                                <option value="<?php echo $service_data[0]['customer_id'];?>" selected=""><?php echo $this->customers_database->get_customer($service_data[0]['customer_id']);?></option>
                                <?php 
                                 $customers = $this->customers_database->read();
                                 foreach ($customers as $value){ ?>
                                <option value="<?php echo $value['id'];?>"><?php echo $value['name_'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                        <label>Service Location: </label>
                            <input type="text" name="location" class="form-control" placeholder="Location" required="" value="<?php echo isset($add_location)?$add_location:$service_data[0]['location'];?>"/>
                        </div>
                        <div class="form-group">
                         <label>Service Type: </label>
                            <select name="service_type" style="width: 100%;">
                                <option value="<?php echo $service_data[0]['service_type'];?>" selected=""><?php echo $this->customers_database->get_customer($service_data[0]['service_type']);?></option>
                                <option value="1">Internet</option>
                                <option value="2">VPN</option>
                            </select>
                        </div>
                         <div class="form-group">
                         <label>Billing Cycle: </label>
                            <select name="billing_cycle" style="width: 100%;">
                                <option value="<?php echo $service_data[0]['billing_cycle'];?>" selected="">..Billing Cycle..</option>
                                <option value="1">Monthly</option>
                                <option value="3">Quarterly</option>
                                <option value="12">Annual</option>
                            </select>
                        </div>
                       <div class="form-group">
                       <label>Billing Start Date: </label>
                            <input type="text" name="startdate" class="form-control" placeholder="Billing Start Date" required="" id="datepicker"value="<?php echo isset($add_start_date)?$add_start_date:$service_data[0]['created'];?>"/>
                        </div>
                        <div class="form-group">
                       <label>Billing Expiry Date: </label>
                            <input type="text" name="expirydate" class="form-control" placeholder="Billing Expiry Date" required="" id="datepicker2"value="<?php echo isset($add_expiry_date)?$add_expiry_date:$service_data[0]['expiry_date'];?>"/>
                        </div>
                      </div>
                      <div class="span6 offset1">
                        <div class="form-group">
                           <label>IP Addresses: </label>
                            <input type="text" name="ips" class="form-control" placeholder="IP Addresses" required="" value="<?php echo isset($add_ips)?$add_ips:$service_data[0]['ip_addresses'];?>"/>
                        </div>
                         <div class="form-group">
                          <label>CPE MAC: </label>
                            <input type="text" name="cpemac" placeholder="CPE MAC" class="form-control" required="" value="<?php echo isset($add_cpemac)?$add_cpemac:$service_data[0]['cpe_mac'];?>"/>
                        </div>
                         <div class="form-group">
                          <label>AP CONNECTED: </label>
                            <input type="text" name="apconnected" class="form-control" placeholder="AP CONNECTED" required="" value="<?php echo isset($add_apconnected)?$add_apconnected:$service_data[0]['ap_connected'];?>"/>
                        </div>
                        <div class="form-group">
                          <label>Grace Period: </label>
                            <input type="number" name="graceperiod" class="form-control" placeholder="Grace Period" value="<?php echo isset($add_graceperiod)?$add_graceperiod:$service_data[0]['grace_period'];?>"/>
                        </div>
                         <div class="form-group">
                         <label>Graph Details: </label>
                            <input type="text" class="form-control" name="cpegraph" placeholder="CPE Graph" value="<?php echo isset($add_graph)?$add_graph:$service_data[0]['cpe_graph'];?>"/>
                        </div>
                        <div class="form-group">                       
                            <input type="submit" class="btn btn-success" name="add" value="Update" />
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