<?php

    // configuration
    require("../includes/config.php"); 
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate input
        if (empty($_POST["buy"]))
        {
            apologize("Please enter a stock symbol to buy.");
        }
        else if (empty($_POST["shares"]))
        {
            apologize("Please provide the number of shares to buy.");
        }
        else if (preg_match("/^\d+$/", $_POST["shares"]) != true)
        {
            apologize("Please provide a positive, whole number of shares to buy.");
        }
        
        // store stock symbol (in uppercase)
        $symbol = strtoupper($_POST["buy"]);
        
        // check to make sure valid symbol
        $stock = lookup($symbol);
        if ($stock === false)
        {
            apologize("That symbol is not valid.");
        }

        // calculate total cost
        $cost = $stock["price"] * $_POST["shares"];
        
        // make sure the user has enough cash
        $cashleft = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        $cash = $cashleft[0]["cash"];
        if ($cost > $cash)
        {
            apologize("You do not have enough money.");
        }
        
        // insert stock into database
        query("INSERT INTO stocks (id, symbol, shares) VALUES({$_SESSION['id']}, '$symbol', {$_POST['shares']})
            ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)");
        
        // update cash
        query("UPDATE users SET cash = cash - $cost WHERE id = ?", $_SESSION["id"]);
        
        // insert transaction into history
        query("INSERT INTO history (id, transaction, timestamp, symbol, shares, price) 
            VALUES({$_SESSION['id']}, 'BUY', now(), '$symbol', {$_POST['shares']}, {$stock["price"]})");
        
        // redirect to portfolio
        redirect("/");
    }
    
    else
    {
        // render form
        render("buy_form.php", ["title" => "Buy Stocks"]);
    }

?>
