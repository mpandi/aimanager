<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'header.php'; 
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
                        <li><a href="<?php echo base_url(); ?>" class="active">Home</a></li>
                        <li><a href="<?php echo base_url(); ?>welcome/login">Login</a></li>
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
                                
                    <h1 class="home-title wow fadeIn" data-wow-delay="0.5s">Customer Management System</h1>
                    
                    <p class="home-subtitle wow fadeIn" data-wow-delay="1s">
                        Design &amp; style should always work toward making you look<br>
                        good &amp; feel good - without a lot of efforts - so you can<br>
                        always get on with the things that truly matter.
                    </p>
                    <a href="#" class="btn scrool wow fadeIn" data-wow-delay="1.75s">Discover More!</a>
                                
                </div>
                <!--end col-md-6-->
            
                <!--begin col-md-6-->
                <div class="col-md-6 wow slideInRight" data-wow-delay="2.25s">
                                
                    <iframe src="https://player.vimeo.com/video/93122461?color=fe403a&amp;title=0&amp;byline=0&amp;portrait=0" width="555" height="321" class="frame-border"></iframe>
                                
                </div>
                <!--end col-md-6-->
            
            </div>
            <!--end row-->

        </div>
        <!--end container-->

    </section>
    <!--end home_wrapper -->
<?php include 'footer.php'; ?>