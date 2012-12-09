<?php

    // configuration
    require("../includes/config.php");
    
    // store ingredients from txt file into array
    $ifile = 'ingredients.txt';
    $ihandle = fopen($ifile, 'r');
    if ($ihandle)
    { 
        $ingredients = explode("\n", trim(fread($ihandle, filesize($ifile)))); 
    }
    fclose($ihandle);
    
    // store tags from txt file into array
    $tfile = 'tags.txt';
    $thandle = fopen($tfile, 'r');
    if ($thandle)
    { 
        $tags = explode("\n", trim(fread($thandle, filesize($tfile)))); 
    }
    fclose($thandle);
    
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
        
        // assign value of 1 or 0 for ingredients and tags depending on if user checked it or not
        for($n=0, $numing = count($ingredients); $n<$numing; $n++)
            $i[$n] = isset($_POST['i'][$n]) ? 1 : 0;
        
        for($m=0, $numtag = count($tags); $m<$numtag; $m++)
            $t[$m] = isset($_POST['t'][$m]) ? 1 : 0;
        
        // insert into recipe database
        $rresults = query("INSERT INTO recipes (title, description, instructions) VALUES(?, ?, ?)", 
            $_POST["title"], $_POST["description"], $_POST["instructions"]);
        if ($rresults === FALSE)
        {
            apologize("The recipe could not be submitted.");
        }
        
        // find out what id the recipe just inserted has
        $rows = query("SELECT LAST_INSERT_ID() AS id");
        $id = $rows[0]["id"];
        
        // insert into ingredients and tags array
        $iresults = query("INSERT INTO ingredients (recipes_id, apple, applesauce, bagel, banana, beanburrito, bellpepper, bread, broccoli, butter, carrot, cereal, cheese, chicken, chickwich, chocolatemilk, coffee, coleslaw, condiment, cookie, creamcheese, crispyfishsandwich, cucumber, delimeat, dressing, edamamebeans, eggs, frozenyogurt, gardenburger, granola, grapes, greenpeas, hamburger, hotchocolate, hotdog, hummus, jelly, juice, lettuce, melon, milk, muffin, oatmeal, onion, orange, pasta, pastasauce, peach, peanutbutter, pear, pickle, pudding, rice, ricevinegar, salsa, soda, soup, sourcream, soysauce, spices, sriracha, tofu, tomato, tunasalad, yogurt)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 
            $id, $i[0], $i[1], $i[2], $i[3], $i[4], $i[5], $i[6], $i[7], $i[8], $i[9], $i[10], $i[11], $i[12], $i[13], $i[14], $i[15], $i[16], $i[17], $i[18], $i[19], $i[20], $i[21], $i[22], $i[23], $i[24], $i[25], $i[26], $i[27], $i[28], $i[29], $i[30], $i[31], $i[32], $i[33], $i[34], $i[35], $i[36], $i[37], $i[38], $i[39], $i[40], $i[41], $i[42], $i[43], $i[44], $i[45], $i[46], $i[47], $i[48], $i[49], $i[50], $i[51], $i[52], $i[53], $i[54], $i[55], $i[56], $i[57], $i[58], $i[59], $i[60], $i[61], $i[62], $i[63]);
        if ($iresults === FALSE)
        {
            apologize("The recipe could not be submitted.");
        }
        
        $tresults = query("INSERT INTO tags (recipes_id, breakfast, dessert, dinner, drink, easy, glutenfree, healthy, lunch, snack, vegan, vegetarian) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 
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
        render("recipe_form.php", ["title" => "Submit a Recipe", "ingredients" => $ingredients, "tags" => $tags]);
    }
?>
