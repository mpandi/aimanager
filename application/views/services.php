<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($this->session->userdata['logged_in'])) {
    $username = $this->session->userdata['logged_in']['username'];
    $email = $this->session->userdata['logged_in']['email'];
    $password = $this->session->userdata['logged_in']['password'];
    $level = $this->session->userdata['logged_in']['user_level'];
    $i = 0;
    $style = "";
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
                         <li>
                            <a href="<?php echo base_url(); ?>services/" class="active dropdown-toggle" data-toggle="dropdown">Services
                            <span class="caret" style="margin-top: 0px;"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="add_service">Add Service</a></li>
                            </ul>
                         </li>
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
        <div class="container-fluid"> 
                   <section class="login_content" style="padding:5px;">
                   <?php 
                   $flashfail = $this->session->flashdata('fail_delete');
                   if(isset($error_message) || isset($flashfail)){
                            echo "<div class='alert alert-danger'>";
                            echo $error_message;
                            echo $flashfail;
                            echo "</div>";
                            }
                        else{ 
                           $flashdata = $this->session->flashdata('success_register');
                           $flashdelete = $this->session->flashdata('success_delete');
                           $flashupdate = $this->session->flashdata('success_update');
                            if(isset($flashdata) || $flashdelete || $flashupdate){
                              echo "<div class='alert alert-success'>";
                              echo $flashdata;
                              echo $flashdelete;
                              echo $flashupdate;
                              echo "</div>";
                             } } ?>
                       <div class="row-fluid">                                                                                         
                                <div class="span1"><strong>Delete</strong></div>
                                <div class="span1"><strong>Customer</strong></div>
                                <div class="span1">Service Location</div>
                                <div class="span1">Service Type</div>
                                <div class="span1">Billing Cycle</div>
                                <div class="span1">Network Details</div>
                                <div class="span1">IP Addresses</div>
                                <div class="span1">CPE MAC</div>
                                <div class="span1">AP CONNECTED</div>
                                <div class="span1">CPE Graph</div>
                                <div class="span1">Code To Execute</div>
                                <div class="span1">Remainder</div>
                            </div>                                                
                        <?php foreach ($services_data as $value){ 
                            if($i%2 == 0) $style="background-color:#eee;";
                                  else $style="background-color:#fff;";
                                  $id = $value['id'];
                                  $rem = strtotime($value['created'])+($value['billing_cycle']*30*86400)+($value['grace_period']*86400)-time();
                                  $rema = floor($rem/86400);
                                  $width = floor(($rema/365)*100).'%';
                                  if($rem == 0) $rema = 0.9;
                                  if($rem > 10){
                                    $level = 'high';                                    
                                  }
                                  elseif($rem < 10 && $rem > 3){
                                    $level = 'medium';
                                  }
                                  elseif($rem < 3){
                                    $level = 'low';
                                  }
                            ?>
                            <div class="row-fluid" style="<?php echo $style; ?>">                                  
                                      <div class="span1"> 
                                        <a href="delete_service/<?php echo $id;?>" title="delete" id="delete_event"><i class="fa fa-trash-o" style="color: red;"></i></a>
                                        <a href="update_service/<?php echo $id;?>" title="update" style="padding-left: 5px;"><i class="fa fa-pencil" style="color: green;"></i></a>
                                      </div>
                                      <div class="span1"><?php echo $this->customers_database->get_customer($value['customer_id']);?></div>
                                      <div class="span1"><?php echo $value['location'];?></div>
                                      <div class="span1"><?php 
                                      if($value['service_type']=='1'){
                                         echo "<span style=\"color: #8FC412; \">Internet</span>";
                                         }
                                      elseif($value['service_type']=='2'){
                                         echo "<span style=\"color: black; \">VPN</span>";
                                         }
                                      ?></div>
                                      <div class="span1"><?php 
                                      if($value['billing_cycle']=='1'){
                                         echo "<span style=\"color: #8FC412; \">Monthly</span>";
                                         }
                                      elseif($value['billing_cycle']=='4'){
                                         echo "<span style=\"color: black; \">Quarterly</span>";
                                         }
                                      else echo "<span style=\"color: #8FC412; \">Annual</span>";
                                      ?></div>
                                      <div class="span1"><?php echo $value['network_details'];?></div>
                                      <div class="span1"><?php echo $value['ip_addresses'];?></div>
                                      <div class="span1"><?php echo $value['cpe_mac'];?></div>
                                      <div class="span1"><?php echo $value['ap_connected'];?></div>
                                      <div class="span1"><?php echo $value['cpe_graph'];?></div>
                                      <div class="span1"><?php echo $value['execution_code'];?></div>
                                      <div class="span1" style="padding-top: 5px;"><div id="battery"><div class="battery-level <?php echo $level;?>" style="width: <?php echo $width;?>;">
                                      <span style="padding-bottom: 2px; color: black;"><?php echo $rema;?></span></div></div></div>
                                   </div>
                                    <?php $i++; }  ?>
                </section>
        </div>
        <!--end container-->
    </section>
<?php include 'footer.php'; ?>