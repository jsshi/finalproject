<?php

    // configuration
    require("../includes/config.php");
    
    // set up voting
    include("../templates/votes/Pulse/Pulse.vote.class.php");
    $pulse = new Pulse();
    
    $ingredients = ["milk", "butter", "cheese"];
    $tags = ["breakfast", "lunch", "dinner", "dessert", "snack", "vegetarian", "vegan", "healthy", "glutenfree", "easy", "drink"];
    
    if (isset($_GET['search']))
    {
        $searchTerms = trim($_GET['search']);
        $searchTerms = strip_tags($searchTerms); // remove any html/javascript.
       
        if (strlen($searchTerms) < 3)
            apologize("Search terms must be longer than 3 characters.");
        else
            $searchTermDB = mysql_real_escape_string($searchTerms); // prevent sql injection.
       
        $rows = query("SELECT * FROM ingredients WHERE $searchTermDB = 1");
        if ($rows === FALSE)
        {
            $rows = query("SELECT * FROM tags WHERE $searchTermDB = 1");
            if ($rows === FALSE)
            {
                $rows = query("SELECT * FROM recipes WHERE title like '%{$searchTermDB}%' or description like '%{$searchTermDB}%'");
                if (count($rows) < 1)
                    apologize("The search term provided '{$searchTerms}' yielded no results.");
                else
                {
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

                            foreach($ingredients as $ingredient)
                            {
                                if($i["$ingredient"] == 1)
                                    $row["ingredients"] .= "$ingredient, ";
                            }
                        }
                                
                        // look up tags from database and store in array
                        $ts = query("SELECT * FROM tags WHERE recipes_id=?", $row["id"]);
                        if ($ts === FALSE)
                            apologize("Error finding tags.");
                        
                        if (count($ts) == 1)
                        {
                            // first (and only) row
                            $t = $ts[0];

                            foreach($tags as $tag)
                            {
                                if($t["$tag"] == 1)
                                    $row["tags"] .= "$tag, ";
                            }
                        }
                            
                        // get rid of the final ", "
                        $row["ingredients"] = substr($row["ingredients"], 0, -2);
                        $row["tags"] = substr($row["tags"], 0, -2);
                    }
                }
            }
            else
            {
                foreach($rows as &$row)
                {
                    $row["id"] = $row["recipes_id"];
                    
                    foreach($tags as $tag)
                    {
                        if($row["$tag"] == 1)
                            $row["tags"] .= "$tag, ";
                    }
                    
                    $recs = query("SELECT * FROM recipes WHERE id=?", $row["recipes_id"]);
                    if ($recs === FALSE)
                        apologize("Error finding recipes.");

                    if (count($recs) == 1)
                    {
                        $rec = $recs[0];
                        
                        $row["title"] = $rec["title"];
                        $row["description"] = $rec["description"];
                        $row["instructions"] = $rec["instructions"];
                    }
                        
                    // look up ingredients from database and store in array
                    $is = query("SELECT * FROM ingredients WHERE recipes_id=?", $row["recipes_id"]);
                    if ($is === FALSE)
                        apologize("Error finding ingredients.");
                    
                    if (count($is) == 1)
                    {
                        // first (and only) row
                        $i = $is[0];

                        foreach($ingredients as $ingredient)
                        {
                            if($i["$ingredient"] == 1)
                                $row["ingredients"] .= "$ingredient, ";
                        }
                    }
                        
                    // get rid of the final ", "
                    $row["ingredients"] = substr($row["ingredients"], 0, -2);
                    $row["tags"] = substr($row["tags"], 0, -2);
                }
            }
        }
        else
        {
            foreach($rows as &$row)
            {
                $row["id"] = $row["recipes_id"];
                
                foreach($ingredients as $ingredient)
                {
                    if($row["$ingredient"] == 1)
                        $row["ingredients"] .= "$ingredient, ";
                }
                        
                $recs = query("SELECT * FROM recipes WHERE id=?", $row["recipes_id"]);
                if ($recs === FALSE)
                    apologize("Error finding recipes.");

                if (count($recs) == 1)
                {
                    $rec = $recs[0];
                    
                    $row["title"] = $rec["title"];
                    $row["description"] = $rec["description"];
                    $row["instructions"] = $rec["instructions"];
                }
                    
                // look up tags from database and store in array
                $ts = query("SELECT * FROM tags WHERE recipes_id=?", $row["recipes_id"]);
                if ($ts === FALSE)
                    apologize("Error finding tags.");
                
                if (count($ts) == 1)
                {
                    // first (and only) row
                    $t = $ts[0];
                    
                    foreach($tags as $tag)
                    {
                        if($t["$tag"] == 1)
                            $row["tags"] .= "$tag, ";
                    }
                }
                    
                // get rid of the final ", "
                $row["ingredients"] = substr($row["ingredients"], 0, -2);
                $row["tags"] = substr($row["tags"], 0, -2);
            }
        }
    }
    else
    {
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

                foreach($ingredients as $ingredient)
                {
                    if($i["$ingredient"] == 1)
                        $row["ingredients"] .= "$ingredient, ";
                }
            }
                    
            // look up tags from database and store in array
            $ts = query("SELECT * FROM tags WHERE recipes_id=?", $row["id"]);
            if ($ts === FALSE)
                apologize("Error finding tags.");
            
            if (count($ts) == 1)
            {
                // first (and only) row
                $t = $ts[0];

                foreach($tags as $tag)
                {
                    if($t["$tag"] == 1)
                        $row["tags"] .= "$tag, ";
                }
            }
                
            // get rid of the final ", "
            $row["ingredients"] = substr($row["ingredients"], 0, -2);
            $row["tags"] = substr($row["tags"], 0, -2);
        }
    }

    // render portfolio
    render("home.php", ["rows" => $rows, "pulse" => $pulse]);
?>
