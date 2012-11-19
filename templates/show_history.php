<!-- Prints out history in a table -->
<div>
    <table>
    <tr>
        <th>Transaction</th>	
        <th>Date/Time</th>	
        <th>Symbol</th>
        <th>Shares</th>
        <th>Price</th>
    </tr>
        
        <?php
            foreach($rows as $row)
            {
                print("<tr>");
                print("<td>" . $row["transaction"] . "</td>");
                print("<td>" . $row["timestamp"] . "</td>");		
                print("<td>" . $row["symbol"] . "</td>");
                print("<td>" . $row["shares"] . "</td>");
                print("<td> $" . number_format($row["price"], 2, '.', '') . "</td>");
                print("</tr>");

            }
        ?>
    </table>
</div>

<a href="javascript:history.go(-1);">Back</a>
