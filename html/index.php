<?php

    // configuration
    require("../includes/config.php"); 
    
    // look up symbol and shares for user from database and store in array
    $rows = query("SELECT symbol, shares FROM stocks WHERE id = ?", $_SESSION["id"]);
    
    // figure out how much cash the user has from database
    $cashleft = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    $cash = $cashleft[0]["cash"];
    
    foreach ($rows as &$row)
    {
        // look up symbol's symbol, name, and price
        $stock = lookup($row["symbol"]);
        if($stock === FALSE)
            apologize("Cound not look up stocks.");
        
        // add new rows to the array
        $row["price"] = $stock["price"];
        $row["name"] = $stock["name"]; 
        $row["total"] = $row["shares"] * $row["price"]; 
    }

        
    // render portfolio
    render("portfolio.php", ["title" => "Portfolio", "rows" => $rows, "cash" => $cash]);

?>
