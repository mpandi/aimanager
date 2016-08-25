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
                        <li><a href="<?php echo base_url(); ?>users/">Users</a></li>
                         <?php } ?>
                        <li><a href="<?php echo base_url(); ?>customers/">Customers</a></li>
                        <li>
                            <a href="<?php echo base_url(); ?>services/" class="active dropdown-toggle" data-toggle="dropdown">Services
                            <span class="caret" style="margin-top: 0px;"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="add_service">Add Service</a></li>
                              <li><a href="service_types">Service Types</a></li>
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
      <div class="row-fluid">
               <div class="span6 offset3">
                   <section class="login_content" style="padding:5px;">
                      <div class="eh">Add Service Type </div>
                       <?php $attributes = array('class'=>'form-horizontal login_d');
                        echo form_open('services/add_',$attributes);
                        if(isset($error_message)){
                            echo "<div class='alert alert-danger'>";
                            echo $error_message;
                            echo "</div>";
                            }
                        if(isset($success_message)){
                            echo "<div class='alert alert-success'>";
                            echo $success_message;
                            echo "</div>";
                          } ?>
                        <div class="form-group">
                             <label>Enter Type: </label>
                            <input type="text" class="form-control" name="type_" placeholder="Service Type" required="" value="<?php echo isset($add_type)?$add_type:'';?>"/>
                        </div>
                        <div class="form-group">                       
                              <input type="submit" class="btn btn-success" name="add" value="Add" />
                        </div>                   
                   <?php echo form_close(); ?>
                    </div>
                </section>
                </div>
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
<?php include 'footer.php'; ?>