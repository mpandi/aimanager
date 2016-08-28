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
                        <li><a href="<?php echo base_url(); ?>customers/">Customers</a></li>
                        <li>
                            <a href="<?php echo base_url(); ?>services/" class="active dropdown-toggle" data-toggle="dropdown">Services
                            <span class="caret" style="margin-top: 0px;"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="add_service">Add Service</a></li>
                              <li><a href="service_types">Service Types</a></li>
                            </ul>
                         </li>
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
                             } } 
                    if(isset($services_data)){ ?>
                       <div class="row-fluid">                                                                                         
                                <div class="span1"><strong>Delete</strong></div>
                                <div class="span2"><strong>Customer</strong></div>
                                <div class="span3">Service Location</div>
                                <div class="span1">Service Type</div>
                                <div class="span1">Billing Cycle</div>
                                <div class="span2">Expiry Date</div>
                                <div class="span2">Remaining days</div>
                            </div>                                                
                        <?php foreach ($services_data as $value){ 
                            if($i%2 == 0) $style="background-color:#eee;";
                                  else $style="background-color:#fff;";
                                  $id = $value['id'];
                                  $start_date = $value['created'];
                                  $expiry_date = $value['expiry_date'];
                                  $billing_cycle = $value['billing_cycle']*30; //convert into days
                                  $rem = strtotime($value['expiry_date'])-time();
                                  $rema = floor($rem/86400);
                                  $total = $rema+$value['grace_period'];
                                  $width = floor(($total/$billing_cycle)*100);
                                  if($width > '66'){
                                    $level = 'high';                                    
                                  }
                                  elseif($width < '66' && $width > '33'){
                                    $level = 'medium';
                                  }
                                 else {
                                    $level = 'low';
                                  }
                            ?>
                            <div class="row-fluid" style="<?php echo $style; ?>">                                  
                                      <div class="span1"> 
                                       <?php if($this->session->userdata['logged_in']['user_level'] == 1){ ?>
                                        <a href="delete_service/<?php echo $id;?>" title="delete" id="delete_event"><i class="fa fa-trash-o" style="color: red;"></i></a>
                                        <?php } ?>
                                        <a href="view_service/<?php echo $id;?>" title="view" style="padding-left: 5px;"><i class="fa fa-eye" style="color: green;"></i></a>
                                      </div>
                                      <div class="span2"><?php echo $this->customers_database->get_customer($value['customer_id']);?></div>
                                      <div class="span3"><?php echo $value['location'];?></div>
                                      <div class="span1"><?php echo $this->services_database->get_service($value['service_type']);?></div>
                                      <div class="span1"><?php 
                                      if($value['billing_cycle']=='1'){
                                         echo "<span style=\"color: #8FC412; \">Monthly</span>";
                                         }
                                      elseif($value['billing_cycle']=='3'){
                                         echo "<span style=\"color: black; \">Quarterly</span>";
                                         }
                                      else echo "<span style=\"color: #8FC412; \">Annual</span>";
                                      ?></div>
                                      <div class="span2"><?php echo $expiry_date;?></div>
                                      <div class="span2" style="padding-top: 5px;">
                                         <div class="row-fluid">
                                         <div id="battery" class="span7">
                                            <div class="battery-level <?php echo $level;?>" style="width: <?php echo $width.'%';?>;"></div></div>
                                         <div class="span5" style="padding-bottom: 2px; color: black; float: left;"><?php echo $rema;?> days</div></div>
                                      </div>
                                   </div>
                                    <?php $i++; } } ?>
                </section>
        </div>
        <!--end container-->
    </section>
<?php include 'footer.php'; ?>