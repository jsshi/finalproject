<!-- Prints out portfolio in a table -->
<div>
    <ul id="nav">
    <li><a href="quote.php">Quote</a></li>
    <li><a href="buy.php">Buy</a></li>
    <li><a href="sell.php">Sell</a></li>
    <li><a href="history.php">History</a></li>
    <li><a href="change.php">Change Password</a></li>
    <li><a href="logout.php">Log Out</a></li>
    </ul>
</div>
<br/>
<div>
    <table>
        <tr>
            <th>Symbol</th>	
            <th>Name</th>	
            <th>Shares</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        
        <?php
            foreach($rows as $row)
            {
                print("<tr>");
                print("<td>" . $row["symbol"] . "</td>");
                print("<td>" . $row["name"] . "</td>");		
                print("<td>" . $row["shares"] . "</td>");
                print("<td> $" . number_format($row["price"], 2, '.', '') . "</td>");
                print("<td> $" . number_format($row["total"], 2, '.', '') . "</td>");
                print("</tr>");

            }
        ?>
        <tr>
            <td>CASH REMAINING</td>
            <td></td>
            <td></td>
            <td></td>
            <td>$<?= number_format($cash, 2, '.', '') ?> </td>
        </tr>
    </table>
</div>
