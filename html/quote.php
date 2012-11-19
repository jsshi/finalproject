<?php

    // configuration
    require("../includes/config.php"); 
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate input
        if (empty($_POST["quote"]))
        {
            apologize("You must enter a stock symbol.");
        }

        // look up stock
        $stock = lookup($_POST["quote"]);
        if ($stock === false)
        {
            apologize("That symbol is not valid.");
        }
        
        // show the stock results
        render("show_quote.php", ["title" => "Stock Results", "symbol" => $stock["symbol"], 
            "name" => $stock["name"], "price" => $stock["price"]]);
    }
    
    else
    {
        // render form
        render("quote_form.php", ["title" => "Stock Search"]);
    }

?>
