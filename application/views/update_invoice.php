<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (isset($this->session->userdata['logged_in'])) {
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
                        <li><a href="<?php echo base_url(); ?>invoices/" class="active">Invoices</a></li>
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
        <div class="container-fluid"> 

            <!--begin row-->
            <div class="row-fluid login_content">
                  <div class="eh">Update: <span style="color: black;"><?php echo $this->services_database->get_service_location($invoices_data[0]['service']);?></span> </div>
                       <?php $attributes = array('class'=>'form-horizontal login_d');
                        echo form_open('invoices/update',$attributes);
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
                      <div class="span5">                    
                        <div class="form-group" style="padding-top: 5px;">
                         <label>Service: </label>
                         <input type="hidden" name="invoice_id" value="<?php echo $invoices_data[0]['id'];?>"/>
                            <select name="service" style="width: 100%;">
                                <option value="<?php echo $invoices_data[0]['service'];?>" selected=""><?php echo $this->services_database->get_service_location($invoices_data[0]['service']);?></option>
                                <?php $services_data = $this->services_database->read();
                                  if(is_array($services_data)){
                                   foreach ($services_data as $value){ ?>
                                <option value="<?php echo $value['id'];?>"><?php echo $value['location'];?></option>
                                <?php } } else echo "no services"; ?>
                            </select>
                        </div>
                        <div class="form-group" style="padding-top: 5px;">
                         <label>Customer Name: </label>
                            <select name="customer" style="width: 100%;">
                                <option value="<?php echo $invoices_data[0]['customer_id'];?>" selected=""><?php echo $this->customers_database->get_customer($invoices_data[0]['customer_id']);?></option>
                                <?php $customers_data = $this->customers_database->read();
                                if(is_array($customers_data)){
                                 foreach ($customers_data as $value){ ?>
                                  <option value="<?php echo $value['id'];?>"><?php echo $value['name_'];?></option>
                                  <?php } } else echo "no customers"; ?>
                            </select>
                        </div>
                      </div>
                      <div class="span5 offset1">   
                          <div class="form-group" style="padding-top: 5px;">
                            <label>INVOICE DATE: </label>
                            <input type="text" class="form-control" name="invoicedate" id="datepicker3" placeholder="Invoice Date" value="<?php echo isset($add_date)?$add_date:$invoices_data[0]['invoice_date'];?>"/>
                         </div>
                         <div class="form-group" style="padding-top: 5px;">
                            <label>INVOICE LINK: </label>
                            <input type="text" class="form-control" name="invoicelink" placeholder="Invoice Link" value="<?php echo isset($add_link)?$add_link:$invoices_data[0]['invoice_link'];?>"/>
                        </div>
                        <div class="form-group">                       
                            <input type="submit" class="btn btn-success" name="add" value="Update" />
                        </div> 
                   </div>     
                <?php echo form_close(); ?> 
                </div>
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
<?php include 'footer.php'; ?>