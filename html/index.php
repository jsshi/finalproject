<?php

    // configuration
    require("../includes/config.php"); 
    
    // look up recipes from database and store in array
    $rows = query("SELECT * FROM recipes");
        
    // render portfolio
    render("home.php", ["rows" => $rows]);

?>
