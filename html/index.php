<?php

    // configuration
    require("../includes/config.php");
    
    // set up voting
    include("../templates/votes/Pulse/Pulse.vote.class.php");
    $pulse = new Pulse();
    
    // define ingredients and tags
    $ingredients = ["milk", "butter", "cheese"];
    $tags = ["breakfast", "lunch", "dinner", "dessert", "snack", "vegetarian", "vegan", "healthy", "glutenfree", "easy", "drink"];
    
    // if the user searched for something
    if (isset($_GET['search']))
    {
        // prepare search terms
        $searchTerms = trim($_GET['search']);
        $searchTerms = strip_tags($searchTerms);
       
        if (strlen($searchTerms) < 3)
            apologize("Search terms must be longer than 3 characters.");
        else
            $searchTermDB = mysql_real_escape_string($searchTerms); 

        // check in ingredients database       
        $rows = query("SELECT * FROM ingredients WHERE $searchTermDB = 1");
        if ($rows === FALSE)
        {
            // check in tags database
            $rows = query("SELECT * FROM tags WHERE $searchTermDB = 1");
            if ($rows === FALSE)
            {
                // check in recipes database
                $rows = query("SELECT * FROM recipes WHERE title like '%{$searchTermDB}%' or description like '%{$searchTermDB}%'");
                if (count($rows) < 1)
                    apologize("The search term provided '{$searchTerms}' yielded no results.");
                else
                {
                    // loop through results from recipes database
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

                            // add ingredients to array in one key
                            foreach($ingredients as $ingredient)
                            {
                                if($i["$ingredient"] == 1)
                                    $row["ingredients"] .= "$ingredient, ";
                            }
                        }
                                
                        // look up tags from tags database and store in array
                        $ts = query("SELECT * FROM tags WHERE recipes_id=?", $row["id"]);
                        if ($ts === FALSE)
                            apologize("Error finding tags.");
                        
                        if (count($ts) == 1)
                        {
                            // first (and only) row
                            $t = $ts[0];
                            
                            // add tags to array in one key
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
                // loop through results from tags database
                foreach($rows as &$row)
                {
                    // store id
                    $row["id"] = $row["recipes_id"];
                    
                    // add tags to array in one key
                    foreach($tags as $tag)
                    {
                        if($row["$tag"] == 1)
                            $row["tags"] .= "$tag, ";
                    }
                    
                    // look up recipe information
                    $recs = query("SELECT * FROM recipes WHERE id=?", $row["recipes_id"]);
                    if ($recs === FALSE)
                        apologize("Error finding recipes.");

                    if (count($recs) == 1)
                    {
                        // first (and only) row
                        $rec = $recs[0];
                        
                        // add information to array
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

                        // add ingredients to array in one key
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
            // loop through results from ingredients database
            foreach($rows as &$row)
            {
                // store id
                $row["id"] = $row["recipes_id"];
                
                // add ingredients to array in one key
                foreach($ingredients as $ingredient)
                {
                    if($row["$ingredient"] == 1)
                        $row["ingredients"] .= "$ingredient, ";
                }
                        
                // look up recipe information
                $recs = query("SELECT * FROM recipes WHERE id=?", $row["recipes_id"]);
                if ($recs === FALSE)
                    apologize("Error finding recipes.");

                if (count($recs) == 1)
                {
                    // first (and only) row
                    $rec = $recs[0];
                    
                    // add information to array
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
                    
                    // add tags to array in one key
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
        // look up all recipes from database and store in array
        $rows = query("SELECT * FROM recipes");
        if ($rows === FALSE)
            apologize("No recipes have been submitted yet!");
       
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

                // add ingredients to array in one key
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

                // add tags to array in one key
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
