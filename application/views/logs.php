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
                        <li><a href="<?php echo base_url(); ?>customers/">Customers</a></li>
                        <li><a href="<?php echo base_url(); ?>services/">Services</a></li>
                        <li><a href="<?php echo base_url(); ?>logs/" class="active">Logs</a></li>
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
                                <th>Subject</th>
                                <th>User</th>
                                <th>Message</th>
                                <th>Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($logs_data as $value){
                                  $id = $value['id'];?>
                                    <tr class="even pointer">
                                      <td class=" "><?php echo $value['subject'];?></td>
                                      <td><?php echo $value['userid'];?></td>
                                      <td class=" "><?php echo $value['message'];?></td>
                                      <td class=" "><?php echo $value['date_'];?></td>
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