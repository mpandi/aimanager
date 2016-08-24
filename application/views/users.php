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
                        <li><a href="<?php echo base_url(); ?>users/" class="active">Users</a></li>
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
            <div class="row margin-bottom-30">
                <!--begin col-md-6-->
                <div class="col-md-4 padding-top-20">                                
                    <h1 class="home-title wow fadeIn" data-wow-delay="0.5s">Users</h1>                   
                    <p class="home-subtitle wow fadeIn" data-wow-delay="1s">
                       View all users, their emails, levels and account statuses.<br/>
                        Also add or remove users.
                    </p>
                    <a href="registration" class="btn scrool wow fadeIn">Add User</a>                             
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
                            if(isset($flashdata) || $flashdelete){
                              echo "<div class='alert alert-success'>";
                              echo $flashdata;
                              echo $flashdelete;
                              echo "</div>";
                             } ?>
                       <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">                                              
                                <th><strong>Delete</strong></th>
                                <th><strong>Username</strong></th>
                                <th>Email</th>
                                <th>Acc Status </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($user_data as $value){
                                  $id = $value['id'];?>
                                    <tr class="even pointer">
                                      <td class=" "> <a href="delete_user/<?php echo $id;?>" title="Delete user" id="delete_event"><i class="fa fa-trash-o"></i></a></td>
                                      <td class=" "><?php echo $value['username'];?></td>
                                      <td><?php echo $value['email'];?></td>
                                      <td class=" "><?php 
                                      if($value['status']=='0'){
                                         echo "<span style=\"color: red; \">Inactive</span>";
                                         }
                                      elseif($value['level']=='2'){
                                         echo "<span style=\"color: #8FC412; \">Regular User</span>";
                                         }
                                      elseif($value['level']=='3') echo "<span style=\"color: black; \">Operator</span>";
                                      ?></td>
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