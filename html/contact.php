<?php
    // sends email, adapted from David Malan's code during 10/31 lecture 
    
    // configuration
    require("PHPMailer/class.phpmailer.php");
    require("../includes/config.php");

    // validate submission
    if (!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["message"]))
    {
        // instantiate mailer
        $mail = new PHPMailer();
         
        // use SMTP
        $mail->IsSMTP();
        $mail->Host = "smtp.fas.harvard.edu";
          
        // set From:
        $email = $_POST["email"];
        $mail->SetFrom("$email");
          
        // set To:
        $mail->AddAddress("jennifershi@college.harvard.edu");
        $mail->AddAddress("annieyang@college.harvard.edu");

        // set Subject:
        $mail->Subject = "Better Eats Comments";
             
        // set body
        $mail->Body = "This person has a few comments:\n\n" .
            "Name: " . $_POST["name"] . "\n" .
            "Email: " . $email . "\n" .
            "Message: " . $_POST["message"];

        // send mail
        if ($mail->Send() == false)
        {
            die($mail->ErrInfo);
        }
        
        // show success page
        render("success.php", ["title" => "Email Submitted!"]);
    }
    else
    {
        // render contact info
        render("contactinfo.php", ["title" => "Contact us!"]);
    }
?>
