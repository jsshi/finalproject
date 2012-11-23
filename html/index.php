<?php

    // configuration
    require("../includes/config.php"); 
    
    // look up recipes from database and store in array
    $rows = query("SELECT * FROM recipes");
        
    $ingredients = "";
    $tags = "";
    
    foreach ($rows as &$row)
    {
        if($row["milk"] == 1)
            $ingredients .= "milk, ";
        if($row["butter"] == 1)
            $ingredients .= "butter, ";
        if($row["cheese"] == 1)
            $ingredients .= "cheese, ";
        
        if($row["breakfast"] == 1)
            $tags .= "breakfast, ";
        if($row["lunch"] == 1)
            $tags .= "lunch, ";
        if($row["dinner"] == 1)
            $tags .= "dinner, ";
    }

    // get rid of the final ", "
    $ingredients = substr($ingredients, 0, -2);
    $tags = substr($tags, 0, -2);

    // render portfolio
    render("home.php", ["rows" => $rows, "ingredients" => $ingredients, "tags" => $tags]);
?>
