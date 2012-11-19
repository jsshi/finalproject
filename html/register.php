<?php

    // configuration
    require("../includes/config.php");
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // check inputs
        if (empty($_POST["username"]))
        {
            apologize("Please provide a username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("Please provide a password.");
        }
        else if ($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Please provide matching passwords.");
        }
        
        // insert user into database
        $results = query("INSERT INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)",
            $_POST["username"], crypt($_POST["password"]));
        if ($results === FALSE)
        {
            apologize("That username already exists.");
        }
        
        // find out which id the user was assigned
        $rows = query("SELECT LAST_INSERT_ID() AS id");
        $id = $rows[0]["id"];
        
        // log in the user
        $_SESSION["id"] = $id;
        
        // redirect to index.php
        redirect("/");
    }
    else
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }
?>
