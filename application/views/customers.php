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
                         <li><a href="<?php echo base_url(); ?>customers/" class="active">Customers</a></li>
                        <li><a href="<?php echo base_url(); ?>services/">Services</a></li>
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
                <div class="col-md-4 padding-top-20">                                
                    <h3 class="home-title" data-wow-delay="0.5s">Customers</h3>                   
                    <p class="home-subtitle wow fadeIn" data-wow-delay="1s">
                       View all customers, their emails, levels and account statuses.<br/>
                        Also add or remove users.
                    </p>
                    <a href="add_customer" class="btn btn-lg btn-white-transparent btn-margin scrool wow fadeIn" data-wow-delay="1.75s">Add Customer</a>                             
                </div>
                <!--end col-md-6-->     
                <!--begin col-md-6-->
                <div class="col-md-8 wow slideInRight" data-wow-delay="2.25s">
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
                                <th><strong>Action</strong></th>
                                <th><strong>Customer</strong></th>
                                <th><strong>Address</strong></th>
                                <th>Billing Contact</th>
                                <th>Technical Contact</th>
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
                                      <td class=" "><?php echo $value['billing_contact'];?></td>
                                      <td class=" "><?php echo $value['technical_contact'];?></td>
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