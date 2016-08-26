<?php
require_once 'lib/swift_required.php';

/// Create the SMTP configuration
$transport = Swift_SmtpTransport::newInstance("mail.ainetworks.sl", 26);
$transport->setUsername("ainman@ainetworks.sl");
$transport->setPassword("Disc0nect2016");
// Create the message
$message = Swift_Message::newInstance();
$message->setTo(array(
  "pandimoses@gmail.com" => "Moses Pandi"
));
$message->setSubject("Service Expiry Email");
$message->setBody("You're our best client ever.");
$message->setFrom("ainman@ainetworks.sl", "AI Manager");

// Send the email
$mailer = Swift_Mailer::newInstance($transport);
$mailer->send($message, $failedRecipients);

// Show failed recipients
print_r($failedRecipients);
?>