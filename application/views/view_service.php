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
            <div class="container-fluid">              
                <div>
                    <ul class="nav navbar-nav navbar-right">                  
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <?php if($level == 1){ ?>
                        <li><a href="<?php echo base_url(); ?>users/">Users</a></li>
                         <?php } ?>
                        <li><a href="<?php echo base_url(); ?>customers/">Customers</a></li>
                        <li><a href="<?php echo base_url(); ?>services/" class="active">Services</a></li>
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
        <div class="row-fluid"> 
                <div class="span7 offset3 slideInRight">
                   <section class="login_content" style="padding:5px;">
                       <?php 
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
                       <div class="row-fluid">
                        <table class="span6">
                          <tr>
                            <td><label>Customer Name: </label></td>
                            <td><?php echo $this->customers_database->get_customer($service_data[0]['customer_id']);?></td>
                          </tr>
                          <tr>
                            <td><label>Service Location: </label></td>
                            <td><?php echo isset($add_location)?$add_location:$service_data[0]['location'];?></td>
                        </tr>
                        <tr>
                           <td><label>Service Type: </label></td>
                           <td><?php if($service_data[0]['service_type']=='1'){
                                         echo "<span style=\"color: #8FC412; \">Internet</span>";
                                         }
                                     elseif($service_data[0]['service_type']=='2'){
                                         echo "<span style=\"color: black; \">VPN</span>";
                                         }
                                      ?></td>
                        </tr>
                        <tr>
                         <td><label>Billing Cycle: </label></td>
                           <td><?php if($service_data[0]['billing_cycle']=='1'){
                                         echo "<span style=\"color: #8FC412; \">Monthly</span>";
                                         }
                                      elseif($service_data[0]['billing_cycle']=='4'){
                                         echo "<span style=\"color: black; \">Quarterly</span>";
                                         }
                                      else echo "<span style=\"color: #8FC412; \">Annual</span>";
                                      ?></td>
                        </tr>
                        <tr>
                         <td><label>Billing Start Date: </label></td>
                         <td><?php echo $service_data[0]['created'];?></td>
                         </tr>                        
                        <tr>
                           <td><label>IP Addresses: </label></td>
                           <td><?php echo $service_data[0]['ip_addresses'];?></td>
                        </tr>
                       </table>
                       <table class="span6">
                        <tr>
                          <td><label>CPE MAC: </label></td>
                          <td><?php echo $service_data[0]['cpe_mac'];?></td>
                        </tr>                                                
                        <tr>
                          <td><label>AP CONNECTED: </label></td>
                          <td><?php echo $service_data[0]['ap_connected'];?></td>
                        </tr>
                        <tr>
                          <td><label>Grace Period: </label></td>
                          <td><?php echo $service_data[0]['grace_period'];?> days</td>
                        </tr>
                         <tr>
                          <td><label>CODE: </label></td>
                          <td><?php echo $service_data[0]['execution_code'];?></td>
                        </tr>
                         <tr>
                           <td><label>Graph Details: </label></td>
                           <td><?php echo $service_data[0]['cpe_graph'];?></td>
                        </tr>
                        <tr><td></td>                      
                        <td><a href="<?php echo base_url();?>services/update_service/<?php echo $service_data[0]['id'];?>" title="view" style="padding-left: 5px; color: green;">Edit <i class="fa fa-eye" style="color: green;"></i></a></td>
                        </tr> 
                       </table>
                    </div>
                   </div>
                </section>  
            </div>    
        </div>
    </section>
<?php include 'footer.php'; ?>