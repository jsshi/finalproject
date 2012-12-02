<!-- Displays the home page of the website -->
<head>
    <?php echo Pulse::css();
    echo Pulse::javascript(); ?>
</head>

<div class="row">
    <div class="eight columns">
        <h3>Welcome to Better Eats! <br/>
        <small>Discover and share recipes that only use ingredients found in the dining halls.</small></h3>
    </div>
    <div class="three columns" aligh="right">
        <br/>
        <form method="GET" action="index.php" name="searchForm">
            <input type="text" name="search" placeholder="Search" value="<?php echo isset($searchTerms)?htmlspecialchars($searchTerms):''; ?>" />
            <input type="submit" name="submit" value="Search!" />
        </form>
    </div>
</div>
<hr/>

<?php foreach($rows as $row)
{
    print("<div class='row'>
        <div class='nine columns'>
            <p><a href='#' data-reveal-id='recipe".$row["id"]."' class='button'>" . htmlspecialchars($row["title"]) . "</a></p>
            <p>" . htmlspecialchars($row["description"]) . "</p>" . 
            $pulse->voteHTML($row["id"]) . 
        "</div><hr/>
    </div>
    <div id='recipe".$row["id"]."' class='reveal-modal'>
        <h3>" . htmlspecialchars($row["title"]) . "</h3>
        <p><i>" . htmlspecialchars($row["description"]) . "</i></p>
        <p>" . $row["ingredients"] . "</p>
        <p>" . htmlspecialchars($row["instructions"]) . "</p>
        <p>" . $row["tags"] . "</p>
    <a class='close-reveal-modal'>x</a></div>");
}
?>