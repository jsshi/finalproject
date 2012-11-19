<?php

    // configuration
    require("../includes/config.php");
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // get current hash
        $result = query("SELECT * FROM users WHERE id = ?", $_SESSION["id"]);
        $hash = $result[0]["hash"];
     
        // check inputs
        if (crypt($_POST["current"], $hash) != $hash)
        {
            apologize("Please enter current password.");
        }
        else if (empty($_POST["new"]))
        {
            apologize("Please provide a new password.");
        }
        else if ($_POST["new"] != $_POST["confirmation"])
        {
            apologize("Please provide matching passwords.");
        }
        
        // hash new password
        $new = crypt($_POST['new']);
        
        // update password
        query("UPDATE users SET hash = '$new' WHERE id = ?", $_SESSION["id"]);
        
        // redirect to index.php
        redirect("/");
    }
    else
    {
        // else render form
        render("change_form.php", ["title" => "Change Password"]);
    }
?>
