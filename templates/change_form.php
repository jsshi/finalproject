<!-- Asks the user to fill out the form to change password -->
<form action="change.php" method="post">
    <fieldset>
        <div class="control-group">
            <input autofocus name="current" placeholder="Current Password" type="password"/>
        </div>
        <div class="control-group">
            <input name="new" placeholder="New Password" type="password"/>
        </div>
        <div class="control-group">
            <input name="confirmation" placeholder="Confirm password" type="password"/>
        </div>
        <div class="control-group">
            <button type="submit" class="btn">Submit</button>
        </div>
    </fieldset>
</form>
<div>
    <a href="javascript:history.go(-1);">Back</a>
</div>
