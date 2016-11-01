<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (isset($this->session->userdata['logged_in'])){
    $username = $this->session->userdata['logged_in']['username'];
    $email = $this->session->userdata['logged_in']['email'];
    $password = $this->session->userdata['logged_in']['password'];
    $level = $this->session->userdata['logged_in']['user_level'];
    if($level != '1'){
         redirect('login/', 'refresh');
    }
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
                        <li>
                            <a href="<?php echo base_url(); ?>invoices/" class="active dropdown-toggle" data-toggle="dropdown">Invoices
                            <span class="caret" style="margin-top: 0px;"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="add_invoice/0">Add Invoice</a></li>
                            </ul>
                         </li>
                         <?php } ?>
                        <li><a href="<?php echo base_url(); ?>customers/">Customers</a></li>
                        <li><a href="<?php echo base_url(); ?>services/">Services</a></li>
                        <li><a href="<?php echo base_url(); ?>logs/">Logs</a></li>
                        <li><a href="dashboard">My Account</a></li>
                        <li><a href="<?php echo base_url(); ?>logout/">Logout</a></li>
                    </ul>
                </div>
                <!--end navbar -->
                                    
            </div>
    		<!--end container -->
            
        </nav>
    	<!--end nav -->
        
    </header>
    <section id="home_wrapper" class="home-wrapper">
        <!--begin container-->
        <div class="container-fluid"> 
            <!--begin row-->
            <div class="row-fluid">
                <div class="row wow slideInRight">
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
                           $flashnocu = $this->session->flashdata('nonexistent');
                           $flashupdate = $this->session->flashdata('success_update');
                            if(isset($flashdata) || $flashdelete || $flashnocu || $flashupdate){
                              echo "<div class='alert alert-success'>";
                              echo $flashdata;
                              echo $flashdelete;
                              echo $flashnocu;
                              echo $flashupdate;
                              echo "</div>";
                             } ?>
                       <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">                                              
                                <th>Action</th>
                                <th>Customer</th>
                                <th>Service Loc. No.</th>
                                <th>Service Location</th> 
                                <th>Invoice Date</th>
                                <th>Invoice Link</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($invoices_data)){
                        foreach ($invoices_data as $value){
                                  $id = $value['id'];?>
                                    <tr class="even pointer">
                                      <td class=""> 
                                        <a href="delete_invoice/<?php echo $id;?>" title="delete" id="delete_event"><i class="fa fa-trash-o" style="color: red;"></i></a>
                                        <a href="update_invoice/<?php echo $id;?>" title="update" style="padding-left: 5px;"><i class="fa fa-pencil" style="color: green;"></i></a></td>
                                      <td class=" "><?php echo $this->customers_database->get_customer($value['customer_id']);?></td>
                                      <td class=" "><?php echo $this->services_database->get_service_location_number($value['service']);?></td>
                                      <td class=" "><?php echo $this->services_database->get_service_location($value['service']);?></td>
                                      
                                      <td class=" "><?php echo $value['invoice_date'];?></td>
                                      <td class=" "><a href="<?php echo base_url().'invoices/'.$value['invoice_link'];?>"><?php echo $value['invoice_link'];?></a></td>                                     
                                    </tr>
                                    <?php } } ?>
                                </tbody>
                    </table>
                    <?php } ?>
                </section>
                </div>
                <!--end col-md-6-->    
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
<?php include 'footer.php'; ?>