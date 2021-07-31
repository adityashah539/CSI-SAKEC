<?php
    session_start();
    require_once "config.php";
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
    // "Msg_of_contact_person"  =  mocp 
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //$body = $_POST['mocp'];
        $body ="Hey Thankyou for contacting us this is to acknowledge you that we received your request and our coordinators will soon get in touch with you at the earliest possible , have a great day ";
        $headers = "From: guptavan96@gmail.com";
        if($_POST['contact_us_email']!=null)
        {
            $to_email =trim($_POST['contact_us_email']) ;
        }
        else
        {
            $to_email = trim($_POST['eocp']);
        } 
        $msg= trim($_POST['mocp']);
        $n=strpos($to_email, ".")+1;
        $subject = "Acknowledgement from CSI to ".substr($to_email,0, strpos($to_email, "."))." ".substr($to_email,$n, strpos($to_email, "_")-$n);
        if(isset($_POST['contact_us_email'])&&isset($_POST['contact_us_email'])){
        //send_mail($to_email, $subject, $body, $headers);
            if(strpos($to_email, "@sakec.ac.in")||strpos($to_email, "@gmail.com")){
                $sql = "INSERT INTO query (c_email,c_query) VALUES ('$to_email','$msg')";
                $stmt = mysqli_query($conn, $sql);
                function_alert("Msg has been deliverd."); 
                mysqli_close($conn);
            }else {
                function_alert("Pls enter the sakec's or your own emailid.");
            }
        }else {
            function_alert("Pls fill details properly.");
        }
    }else {
        function_alert("Something went worng.");
    }
?>