<?php
require_once 'lib/swift_required.php';
require_once "config.php";
require      "functions.php";
//ini_set("date.timezone", "Africa/Nairobi");
$transport = Swift_SmtpTransport::newInstance("mail.ainetworks.sl", 26);
$transport->setUsername("ainman@ainetworks.sl");
$transport->setPassword("Disc0nect2016");
$date = date("Y-m-d",time()+259200); // + 3 days
$now = date("Y-m-d",time()); // today
  $expiry_notice = mysql_query("SELECT * FROM services ORDER BY id ASC") or die(mysql_error());
    while($rows = mysql_fetch_array($expiry_notice)){
        $customer_id = $rows['customer_id'];
        $expiry_date = $rows['expiry_date'];
        $date_ = date("Y-m-d",strtotime($expiry_date));
        $grace_period = $rows['grace_period'];
        $total_period = strtotime($expiry_date)+ ($grace_period*24*3600);
        $expired_grace_period = date("Y-m-d",$total_period);
        $customer_details = get_details($customer_id);
        $billing_email = $customer_details[0]['billing_contact_email'];
        $technical_email = $customer_details[0]['technical_contact_email'];
        $name = $customer_details[0]['name_'];
        
        if($date == $date_){ //3 days to expiry
            $message = "";
        }
        elseif($expired_grace_period == $now){ //service expired today
            $message = "";
        }
        elseif($total_period == $now){ //grace period passed
            $message = "";
        }
        // Create the message
        $message = Swift_Message::newInstance();
        $message->setTo(array(
          $billing_email => $name,
          $technical_email => $name
        ));
        //$message->setCc(array("another@fake.com" => "Aurelio De Rosa"));
        //$message->setBcc(array("boss@bank.com" => "Bank Boss"));
        $message->setSubject("Service Expiry Email");
        $message->setBody("You're our best client ever.");
        $message->setFrom("ainman@ainetworks.sl", "AI Manager");
        
        // Send the email
        $mailer = Swift_Mailer::newInstance($transport);
        $mailer->send($message, $failedRecipients);
     }
$expired = date("Y-m-d",time()); // expired
  $expiry_notice = mysql_query("SELECT * FROM services WHERE DATE(expiry_date) = '$expired' ORDER BY id ASC") or die(mysql_error());
    while($rows = mysql_fetch_array($expiry_notice)){
        $customer_id = $rows['customer_id'];
        $customer_details = get_details($customer_id);
        $billing_email = $customer_details[0]['billing_contact_email'];
        $technical_email = $customer_details[0]['technical_contact_email'];
        $name = $customer_details[0]['name_'];
        
        // Create the message
        $message = Swift_Message::newInstance();
        $message->setTo(array(
          $billing_email => $name,
          $technical_email => $name
        ));
        //$message->setCc(array("another@fake.com" => "Aurelio De Rosa"));
        //$message->setBcc(array("boss@bank.com" => "Bank Boss"));
        $message->setSubject("Service Expiry Email");
        $message->setBody("You're our best client ever.");
        $message->setFrom("ainman@ainetworks.sl", "AI Manager");
        
        // Send the email
        $mailer = Swift_Mailer::newInstance($transport);
        $mailer->send($message, $failedRecipients);
     }
     //work on grace period expired
?>