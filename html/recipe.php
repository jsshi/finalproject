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
        else if (!isset($_POST["ingredients"]))
        {
            apologize("Please provide ingredients.");
        }
        else if (empty($_POST["instructions"]))
        {
            apologize("Please provide instructions.");
        }
        else if (!isset($_POST["tags"]))
        {
            apologize("Please provide at least one tag.");
        }
        
        // store ingredients and tags in variables
        $ingredients = "";
        foreach($_POST['ingredients'] as $ingredient)
        {
	        $ingredients .= $ingredient . ", ";
        }
        
        $tags = "";
        foreach($_POST['tags'] as $tag)
        {
            $tags .= $tag . ", ";
        }
        
        // get rid of the final ", "
        $ingredients = substr($ingredients, 0, -2);
        $tags = substr($tags, 0, -2); 
        
        // insert into database
        $results = query("INSERT INTO recipes (name, description, ingredients, instructions, tags) VALUES(?, ?, ?, ?, ?)",
            $_POST["title"], $_POST["description"], $ingredients, $_POST["instructions"], $tags);
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
