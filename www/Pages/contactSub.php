<?php
if(file_exists($wd_admin . 'esmtp.json')){
$esmtp = file_get_contents($wd_admin . 'esmtp.json');
$esmtp = json_decode($esmtp, true);
$name = test_input($_POST['name']);
$email = test_input($_POST['email']);
$subject = test_input($_POST['subject']);
$con = test_input($_POST['con']);
require 'Plugins/PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = $esmtp['SMTP'];  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $esmtp['email'];                 // SMTP username
$mail->Password = $esmtp['epass'];                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = $esmtp['port'];                                    // TCP port to connect to
$mail->setFrom($esmtp['email'], 'ContactForm');
$mail->addAddress($esmtp['email'], $esmtp['email']);     // Add a recipient
$mail->isHTML(true);                                  // Set email format to HTML
$mail->Subject = $subject;
$mail->Body    = $name . ' - ' . $email . ' - ' . $con;
$mail->AltBody = $name . ' - ' . $email . ' - ' . $con;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    header('Location: index.php?page=contact.php');;
}
}
else{
  echo "Sorry this contact form has not been setup yet. Please try again later.";
}
?>
