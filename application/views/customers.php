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
                        <li><a href="<?php echo base_url(); ?>invoices/">Invoices</a></li>
                         <?php } ?>
                        <li>
                            <a href="<?php echo base_url(); ?>customers/" class="active dropdown-toggle" data-toggle="dropdown">Customers
                            <span class="caret" style="margin-top: 0px;"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="add_customer">Add Customer</a></li>
                            </ul>
                         </li>
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
                                <th>Address</th>
                                <th>Billing Contact Name</th>
                                <th>Billing Contact Phone</th>
                                <th>Technical Contact Name</th>
                                <th>Technical Contact phone</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($customers_data as $value){
                                  $id = $value['id'];?>
                                    <tr class="even pointer">
                                      <td class=" "> 
                                        <a href="delete_customer/<?php echo $id;?>" title="delete" id="delete_event"><i class="fa fa-trash-o" style="color: red;"></i></a>
                                        <a href="update_customer/<?php echo $id;?>" title="update" style="padding-left: 5px;"><i class="fa fa-pencil" style="color: green;"></i></a></td>
                                      <td class=" "><?php echo $value['name_'];?></td>
                                      <td><?php echo $value['address'];?></td>
                                      <td class=" "><?php echo $value['billing_contact_name'];?></td>
                                      <td class=" "><?php echo $value['billing_contact_phone'];?></td>
                                      <td class=" "><?php echo $value['technical_contact_name'];?></td>
                                      <td class=" "><?php echo $value['technical_contact_phone'];?></td>
                                    </tr>
                                    <?php } ?>
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