<!-- Tells the user the stock symbol, name, and price -->
<div>
    <?= "Stock Symbol:	"	.	$symbol ?>
</div>
<div>
    <?= "Stock Name:	"	.	$name ?>
</div>
<div>
    <?= "Stock Price:	"	.	number_format($price, 2, '.', '') ?>
</div>

<a href="javascript:history.go(-1);">Back</a>
