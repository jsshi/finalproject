<?php

    // configuration
    require("../includes/config.php"); 
    
    // if form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate input
        if (empty($_POST["sell"]))
        {
            apologize("Please enter a stock symbol to sell.");
        }
        
        // store stock symbol (in uppercase)
        $symbol = strtoupper($_POST["sell"]);

        // look up shares in database
        $row = query("SELECT shares FROM stocks WHERE id = ? AND symbol = ?", $_SESSION["id"], $symbol);
        
        // make sure user owns the stock
        if (empty($row))
        {
            apologize("You do not own that stock.");
        }
        
        // find how many shares the user owns
        $shares = $row[0]["shares"];
        
        // look up price of stock
        $stock = lookup($symbol);
        $price = $stock["price"];
        
        // calculate worth of holdings
        $worth = $price * $shares;
        
        // sell stock
        query("DELETE FROM stocks WHERE id = ? AND symbol = ?", $_SESSION["id"], $symbol);
        
        // update cash
        query("UPDATE users SET cash = cash + $worth WHERE id = ?", $_SESSION["id"]);
        
        // insert transaction into history
        query("INSERT INTO history (id, transaction, timestamp, symbol, shares, price) 
            VALUES({$_SESSION['id']}, 'SELL', now(), '$symbol', '$shares', '$price')");
        
        // redirect to portfolio
        redirect("/");
    }
    
    else
    {
        // render form
        render("sell_form.php", ["title" => "Sell Stocks"]);
    }

?>
