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
        
        for($m=0; $m<11; $m++)
            $t[$m] = isset($_POST['t'][$m]) ? 1 : 0;
        
        // insert into databases
        $rresults = query("INSERT INTO recipes (title, description, instructions) VALUES(?, ?, ?)", 
            $_POST["title"], $_POST["description"], $_POST["instructions"]);
        if ($rresults === FALSE)
        {
            apologize("The recipe could not be submitted.");
        }
        
        $rows = query("SELECT LAST_INSERT_ID() AS id");
        $id = $rows[0]["id"];
        
        $iresults = query("INSERT INTO ingredients (recipes_id, milk, butter, cheese) VALUES(?, ?, ?, ?)", 
            $id, $i[0], $i[1], $i[2]);
        if ($iresults === FALSE)
        {
            apologize("The recipe could not be submitted.");
        }
        
        $tresults = query("INSERT INTO tags (recipes_id, breakfast, lunch, dinner, dessert, snack, vegetarian, vegan, healthy, glutenfree, easy, drink) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 
            $id, $t[0], $t[1], $t[2], $t[3], $t[4], $t[5], $t[6], $t[7], $t[8], $t[9], $t[10]);
        if ($tresults === FALSE)
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
