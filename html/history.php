<?php

    // configuration
    require("../includes/config.php"); 
    
    // look up history database
    $rows = query("SELECT * FROM history WHERE id = ?", $_SESSION["id"]);
    
    foreach ($rows as &$row)
    {
        // look up symbol's symbol, name, and price
        $stock = lookup($row["symbol"]);
        if($stock === FALSE)
            apologize("Cound not look up stocks.");
        
        // add price to the array
        $row["price"] = $stock["price"];
    }

    // render portfolio
    render("show_history.php", ["title" => "History", "rows" => $rows]);

?>
