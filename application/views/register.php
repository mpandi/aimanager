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
                        <li><a href="<?php echo base_url(); ?>emails/">Email Form</a></li>
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
                <div class="col-md-6 padding-top-20">                                
                    <h1 class="home-title wow fadeIn" data-wow-delay="0.5s">Add User</h1>                   
                    <p class="home-subtitle wow fadeIn" data-wow-delay="1s">
                       View all users, their emails, levels and account statuses.<br/>
                        Also add or remove users.
                    </p>
                    <a href="<?php echo base_url(); ?>users/" class="btn">View Users</a>                             
                </div>
                <!--end col-md-6-->
            
                <!--begin col-md-6-->
                <div class="col-md-6 wow slideInRight" data-wow-delay="2.25s">
                   <section class="login_content" style="padding:5px;">
                      <div class="eh">Add User </div>
                       <?php $attributes = array('class'=>'form-horizontal login_d');
                        echo form_open('users/add_user',$attributes);
                        if(isset($error_message)){
                            echo "<div class='alert alert-danger'>";
                            echo $error_message;
                            echo "</div>";
                            }
                        if(isset($success_message)){
                            echo "<div class='alert alert-success'>";
                            echo $success_message;
                            echo "</div>";
                          } 
                          echo validation_errors();?>
                        <div class="form-group">
                         <label>Email: </label>
                            <input type="email" class="form-control" name="email" placeholder="Email" required="" value="<?php echo isset($add_email)?$add_email:'';?>"/>
                        </div>
                        <div class="form-group">
                             <label>Username: </label>
                            <input type="text" class="form-control" name="username" placeholder="Username" required="" value="<?php echo isset($add_username)?$add_username:'';?>"/>
                        </div>
                        <div class="form-group">
                             <label>User Type: </label>
                            <select name="type" style="width: 100%;">
                                <option value="" selected="">..Type..</option>
                                <option value="1">Administrator</option>
                                <option value="2">Regular User</option>
                                <option value="3">Operator</option>
                        </select>
                        </div>
                       <div class="form-group">
                             <label>Password: </label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required="" value=""/>
                        </div>
                        <div class="form-group">                       
                              <input type="submit" class="btn btn-success" name="add" value="Add User" />
                        </div> 
                   </div>
                   <?php echo form_close(); ?>
                </section>
                </div>
                <!--end col-md-6-->    
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
<?php include 'footer.php'; ?>