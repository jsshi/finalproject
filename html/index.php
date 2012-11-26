<?php

    // configuration
    require("../includes/config.php");
    
    // set up voting
    include("../templates/votes/Pulse/Pulse.vote.class.php");
    $pulse = new Pulse();
    
    // look up recipes from database and store in array
    $rows = query("SELECT * FROM recipes");
    if ($rows === FALSE)
        apologize("No recipes have been submitted yet!");
   
    // store values in ingredients and tags arrays
    foreach ($rows as &$row)
    {
        // look up ingredients from database and store in array
        $is = query("SELECT * FROM ingredients WHERE recipes_id=?", $row["id"]);
        if ($is === FALSE)
            apologize("Error finding ingredients.");
        
        if (count($is) == 1)
        {
            // first (and only) row
            $i = $is[0];

            if($i["milk"] == 1)
                $row["ingredients"] .= "milk, ";
            if($i["butter"] == 1)
                $row["ingredients"] .= "butter, ";
            if($i["cheese"] == 1)
                $row["ingredients"] .= "cheese, ";
        }
                
        // look up tags from database and store in array
        $ts = query("SELECT * FROM tags WHERE recipes_id=?", $row["id"]);
        if ($ts === FALSE)
            apologize("Error finding tags.");
        
        if (count($ts) == 1)
        {
            // first (and only) row
            $t = $ts[0];

            if($t["breakfast"] == 1)
                $row["tags"] .= "breakfast, ";
            if($t["lunch"] == 1)
                $row["tags"] .= "lunch, ";
            if($t["dinner"] == 1)
                $row["tags"] .= "dinner, ";
        }
            
        // get rid of the final ", "
        $row["ingredients"] = substr($row["ingredients"], 0, -2);
        $row["tags"] = substr($row["tags"], 0, -2);
    }

    // render portfolio
    render("home.php", ["rows" => $rows, "pulse" => $pulse]);
?>
