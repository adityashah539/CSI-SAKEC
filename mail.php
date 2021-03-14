<?php
$to_email = "adityashah539@gmail.com";
$subject = "Simple Email Test via PHP";
$body = "Hi, This is test email send by PHP Script";
$headers = "From: guptavan96@gmail.com";

if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
    echo $to_email."<br>".$subject."<br>".$body."<br>".$headers;
}
?>