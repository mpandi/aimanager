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
                        <li>
                            <a href="<?php echo base_url(); ?>emailsForm/" class="active dropdown-toggle" data-toggle="dropdown">Email Form
                            <span class="caret" style="margin-top: 0px;"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="add_email">Update Email Data</a></li>
                            </ul>
                         </li>
                         <?php } ?>
                         <li><a href="<?php echo base_url(); ?>customers/">Customers</a></li>
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
    <!--end header -->
    <!--begin home_wrapper -->
    <section id="home_wrapper" class="home-wrapper">
        <!--begin container-->
        <div class="container"> 
            <!--begin row-->
            <div class="row margin-bottom-20">
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
                             } }
                        if(isset($emails_data)){
                        foreach ($emails_data as $value){
                                  $id = $value['id'];?>
                                  <div class="receive_message"><h4>Billing Expiry Email</h4>
                                  <?php echo $value['billing_expiry'];?>
                                  </div>
                                  <div class="post_message"><h4>End of Billing Email</h4>
                                  <?php echo $value['end_billing'];?>
                                  </div>
                                  <div class="receive_message"><h4>Grace Period Expiry Email</h4>
                                  <?php echo $value['grace_period_expiry'];?>
                                  </div> 
                                    <?php } } ?>
                </section>
                </div>
                <!--end col-md-6-->    
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
<?php include 'footer.php'; ?>