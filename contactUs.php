<?php
session_start();

function send_mail($to_email, $subject, $body, $headers)
{
if (mail($to_email, $subject, $body, $headers)) {
    echo "Email successfully sent to $to_email...";
} else {
    echo "Email sending failed...";
}
}
//full form of abrevations are as follows
// "Name_of_contact_person"  =  nocp
// "Email_of_contact_person" =  eocp
// "Name_of_contact_person"  =  mocp 

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //$body = $_POST['mocp'];
    $body ="Hey Thankyou for contacting us this is to acknowledge you that we received your request and our coordinators will soon get in touch with you at the earliest possible , have a great day ";
    $headers = "From: guptavan96@gmail.com";
    if(isset($_SESSION["Email"]))
    {
        $to_email = $_SESSION['Email'];
        $n=strpos($to_email, ".")+1;
        $subject = "Acknowledgement from CSI to ".substr($to_email,0, strpos($to_email, "."))." ".substr($to_email,$n, strpos($to_email, "_")-$n);
        send_mail($to_email, $subject, $body, $headers);
    }
    else
    {
        $to_email = $_POST['eocp'];
        $subject = "Acknowledge from CSI to ".$_POST['nocp'];
        send_mail($to_email, $subject, $body, $headers);
    }   
}

?>