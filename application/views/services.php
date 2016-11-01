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
                              <li><a href="<?php echo base_url(); ?>services/">All Services</a></li>
                              <li><a href="add_service">Add Service</a></li>
                              <li><a href="service_types">Service Types</a></li>
                            </ul>
                         </li>
                         <li><a href="<?php echo base_url(); ?>logs/">Logs</a></li>
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
                   <section class="span7 offset3 login_content" style="padding:5px; font-size: 0.9em;">
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
                       <form action="<?php echo base_url(); ?>services/search" method="POST" class="" id="searchForm_" style="text-align: center;">
                            <span class="add-on" style="color: black; font-weight: bolder;">Filter By</span>
                                <select name="filter" class="select">
                                    <option value="all" selected="">..select option..</option>
                                    <option value="customer">Customer Name</option>
                                    <option value="type">Service Type</option>
                                    <option value="expired">Expired</option>
                                 </select>
                            <input type="text" name="search_value" value="" placeholder="" id="new_value" style="width: 40%;"/>
                            <input type="submit" name="filt" value="Filter" style="margin-top: -10px;" />        
                           </form>
                      </div>
                      <?php } ?>
                       <div class="row-fluid">                                                                                         
                                <div class="span3"><b>Action</b></div>
                                <div class="span5"><b>Customer</b></div>
                                <div class="span2"><b>Total Services</b></div>
                            </div>                                                
                        <?php foreach ($services_data as $value){ 
                            if($i%2 == 0) $style="background-color:#eee;";
                                  else $style="background-color:#fff;";
                                  $id = $value['id'];
                                  $cus_id = $value['customer_id'];
                                  
                                  
                            ?>
                            <div class="row-fluid" style="<?php echo $style; ?>">                                  
                                      <div class="span3"> 
                                       <?php if($this->session->userdata['logged_in']['user_level'] == 1){ ?>
                                        <a href="delete_cus_services/<?php echo $cus_id;?>" title="delete all his services" id="delete_event"><i class="fa fa-trash-o" style="color: red;"></i></a>
                                        <?php } ?>
                                        <a href="view_/<?php echo $cus_id;?>" title="view" style="padding-left: 5px;"><i class="fa fa-eye" style="color: green;"></i></a>
                                      </div>
                                      <div class="span5"><?php echo $this->customers_database->get_customer($value['customer_id']);?></div>
                                      
                                      <div class="span2"><?php echo $value['total'];?></div>
                                      
                                      
                                   </div>
                                    <?php $i++; } } ?>
                </section>
        </div>
        <!--end container-->
    </section>
<?php include 'footer.php'; ?>