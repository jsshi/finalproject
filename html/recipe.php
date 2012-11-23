<?php

    // configuration
    require("../includes/config.php");
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // check inputs
        if (empty($_POST["title"]))
        {
            apologize("Please provide a title.");
        }
        else if (empty($_POST["description"]))
        {
            apologize("Please provide a description.");
        }
        else if (empty($_POST["i"]))
        {
            apologize("Please provide ingredients.");
        }
        else if (empty($_POST["instructions"]))
        {
            apologize("Please provide instructions.");
        }
        else if (empty($_POST["t"]))
        {
            apologize("Please provide at least one tag.");
        }
        
        for($n=0; $n<3; $n++)
            $i[$n] = isset($_POST['i'][$n]) ? 1 : 0;
        
        for($m=0; $m<3; $m++)
            $t[$m] = isset($_POST['t'][$m]) ? 1 : 0;
        
        // insert into database
        $results = query("INSERT INTO recipes (name, description, milk, butter, cheese, instructions, breakfast, lunch, dinner)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)", 
            $_POST["title"], $_POST["description"], $i[0], $i[1], $i[2],
            $_POST["instructions"], $t[0], $t[1], $t[2]);
        if ($results === FALSE)
        {
            apologize("The recipe could not be submitted.");
        }
        
        // show success page
        render("success.php", ["title" => "Recipe Submitted!"]);
    }
    else
    {
        // else render form
        render("recipe_form.php", ["title" => "Submit a Recipe"]);
    }
?>
