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
                        <li><a href="<?php echo base_url(); ?>invoices/">Invoices</a></li>
                         <?php } ?>
                        <li><a href="<?php echo base_url(); ?>customers/">Customers</a></li>
                        <li>
                            <a href="<?php echo base_url(); ?>services/" class="active dropdown-toggle" data-toggle="dropdown">Services
                            <span class="caret" style="margin-top: 0px;"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="<?php echo base_url(); ?>services/add_service">Add Service</a></li>
                              <li><a href="<?php echo base_url(); ?>services/service_types">Service Types</a></li>
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
                    if(isset($services_data)){ 
                    if($level == '1'){ ?>
                      <div class="row-fluid">
                       <form action="<?php echo base_url(); ?>services/search" method="POST" class="span6 offset3" id="searchForm_">
                           <span class="add-on" style="color: black; font-weight: bolder;">Filter By</span>
                                <select name="filter" class="select">
                                    <option value="all" selected="">..select option..</option>
                                    <option value="type">Service Type</option>
                                    <option value="expired">Expired</option>
                                 </select>
                            <input type="text" name="search_value" value="" placeholder="" id="new_value" style="width: 40%; margin: 0; color: black;"/>
                            <input type="submit" name="filt" value="Filter" style="margin-top: 2px;" />        
                           </form>
                      </div>
                      <?php } ?>
                       <div class="row-fluid">                                                                                         
                                <div class="span1"><b>Action</b></div>
                                <div class="span2"><b>Customer</b></div>
                                <div class="span2"><b>Service Location</b></div>
                                <div class="span2"><b>Service Type</b></div>
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
                                      <div class="span1"> 
                                       <?php if($this->session->userdata['logged_in']['user_level'] == 1){ ?>
                                        <a href="<?php echo base_url(); ?>services/delete_service/<?php echo $id;?>" title="delete" id="delete_event"><i class="fa fa-trash-o" style="color: red;"></i></a>
                                       <?php if($value['status'] == '1'){ ?>
                                        <a href="<?php echo base_url(); ?>services/disable_service/<?php echo $id;?>" title="disable" id="disable_event"><i class="fa fa-ban" style="color: red; padding-left: 5px;"></i></a>
                                        <?php } else { ?>
                                        <a href="<?php echo base_url(); ?>services/enable_service/<?php echo $id;?>" title="enable" id=""><i class="fa fa-check-circle-o" style="color: blue; padding-left: 5px;"></i></a>
                                        <?php }} ?>
                                        <a href="<?php echo base_url(); ?>services/view_service/<?php echo $id;?>" title="view" style="padding-left: 5px;"><i class="fa fa-eye" style="color: green;"></i></a>
                                      </div>
                                      <div class="span2"><?php echo $this->customers_database->get_customer($value['customer_id']);?></div>
                                      <div class="span2"><?php if($value['status'] == '0'){ ?>
                                      <span style="color: silver;"><?php echo $value['location'];?></span>
                                      <?php } else { 
                                                echo $value['location'];
                                                } ?>
                                        </div>
                                      <div class="span2"><?php echo $value['service_type'];?></div>
                                      <div class="span1"><?php 
                                      if($value['billing_cycle']=='1'){
                                         echo "<span style=\"color: #8FC412; \">Monthly</span>";
                                         }
                                      elseif($value['billing_cycle']=='3'){
                                         echo "<span style=\"color: black; \">Quarterly</span>";
                                         }
                                      elseif($value['billing_cycle']=='6'){
                                         echo "<span style=\"color: black; \">Semi Annual</span>";
                                         }
                                      elseif($value['billing_cycle']=='12'){
                                         echo "<span style=\"color: #8FC412; \">Annual</span>";
                                         }
                                      else echo "<span style=\"color: darkblue; \">Not Billed</span>";
                                      ?></div>
                                      <div class="span1"><?php echo $expiry_date;?></div>
                                      <div class="span3" style="padding-top: 5px;"><?php if($value['status'] == '1'){ ?>
                                         <div class="row-fluid">
                                         <div id="battery" class="span6">
                                            <div class="battery-level <?php echo $level;?>" style="width: <?php echo $width.'%';?>;"></div></div>
                                         <div class="span6" style="padding-bottom: 2px; color: black; float: left;"><?php echo $remain;?></div>
                                         </div>
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