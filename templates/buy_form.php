<!-- Asks user to fill out form for which stock to buy -->
<form action="buy.php" method="post">
    <fieldset>
        <div class="control-group">
            <input autofocus name="buy" placeholder="Stock Symbol" type="text"/>
        </div>
        <div class="control-group">
            <input name="shares" placeholder="Shares" type="text"/>
        </div>
        <div class="control-group">
            <button type="submit" class="btn">Submit</button>
        </div>
    </fieldset>
</form>

<a href="javascript:history.go(-1);">Back</a>
