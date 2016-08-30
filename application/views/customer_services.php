<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($this->session->userdata['customer_logged_in'])){
    $username = $this->session->userdata['customer_logged_in']['username'];
    $email = $this->session->userdata['customer_logged_in']['email'];
    $password = $this->session->userdata['customer_logged_in']['password'];
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
                        <li><a href="<?php echo base_url(); ?>customers/dashboard">My Account</a></li>
                        <li><a href="<?php echo base_url(); ?>customers/services" class="active">My Services</a></li>
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
                   <section class="login_content" style="padding:5px; font-size: 0.9em;">
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
                                
                                <div class="span3"><b>Service Location</b></div>
                                <div class="span2"><b>Service Type</b></div>
                                <div class="span1"><b>IP Address</b></div>
                                <div class="span1"><b>AP Connected</b></div>
                                <div class="span1"><b>Billing Cycle</b></div>
                                <div class="span1"><b>Expiry Date</b></div>
                                <div class="span3"><b>Remaining days</b></div>
                            </div>                                                
                        <?php foreach ($services_data as $value){ 
                            if($i%2 == 0) $style="background-color:#eee;";
                                  else $style="background-color:#fff;";
                                  $id = $value['id'];
                                  $start_date = $value['created'];
                                  $expiry_date = date('Y-m-d',strtotime($value['expiry_date']));
                                  $billing_cycle = $value['billing_cycle']*30; //convert into days
                                  $rem = strtotime($value['expiry_date'])-time();
                                  $rema = floor($rem/86400);
                                  $remain = '';
                                  if($billing_cycle > 0 && $rema > 0){
                                       $remain .= $rema." days";
                                       }
                                  elseif($billing_cycle > 0 && $rema < 0.1){
                                    $rema = '1';
                                    $over = time()-strtotime($value['expiry_date']);
                                    $overdue = floor($over/86400);
                                    $remain .= "<span style='color:red;'>Overdue $overdue days</span>";
                                  }
                                  elseif($billing_cycle == 0 && $rema < 0.1){
                                    $billing_cycle = '1';
                                    $rema = '1';                                    
                                  } 
                                   elseif($billing_cycle == 0 && $rema > 0){
                                    $remain .= $rema." days";
                                    $billing_cycle = '1';
                                                      
                                  } 
                                  $width = floor(($rema/$billing_cycle)*100);
                                  if($width > 100) $width = '100';
                                  if($width < 0) $width = '5';
                                  if($width > '50'){
                                    $level = 'high';                                    
                                  }
                                  elseif($width < '50' && $width > '10'){
                                    $level = 'medium';
                                  }
                                 else {
                                    $level = 'low';
                                  }
                                  
                            ?>
                            <div class="row-fluid" style="<?php echo $style; ?>">                                  
                                      <div class="span3"><?php if($value['status'] == '0'){ ?>
                                      <span style="color: silver;"><?php echo $value['location'];?></span>
                                      <?php } else { 
                                                echo $value['location'];
                                                } ?>
                                        </div>
                                      <div class="span2"><?php echo $value['service_type'];?></div>
                                      <div class="span1"><?php echo $value['ip_addresses'];?></div>
                                      <div class="span1"><?php echo $value['ap_connected'];?></div>
                                      <div class="span1"><?php 
                                      if($value['billing_cycle']=='1'){
                                         echo "<span style=\"color: #8FC412; \">Monthly</span>";
                                         }
                                      elseif($value['billing_cycle']=='3'){
                                         echo "<span style=\"color: black; \">Quarterly</span>";
                                         }
                                      elseif($value['billing_cycle']=='12'){
                                         echo "<span style=\"color: #8FC412; \">Annual</span>";
                                         }
                                      else echo "<span style=\"color: darkblue; \">Not Billed</span>";
                                      ?></div>
                                      <div class="span1"><?php echo $expiry_date;?></div>
                                      <div class="span3" style="padding-top: 5px;"><?php if($value['status'] == '1'){ ?>
                                         <div class="row-fluid">
                                         <div id="battery" class="span7">
                                            <div class="battery-level <?php echo $level;?>" style="width: <?php echo $width.'%';?>;"></div></div>
                                         <div class="span5" style="padding-bottom: 2px; color: black; float: left;"><?php echo $remain;?></div></div>
                                      <?php } else{
                                        echo "<span style='color:red;'>Suspended</span>";} ?>
                                      </div>
                                   </div>
                                    <?php $i++; } } ?>
                </section>
        </div>
        <!--end container-->
    </section>
<?php include 'footer.php'; ?>