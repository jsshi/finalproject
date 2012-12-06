<!-- Displays the home page of the website -->

<div class="row">
    <section class="three columns" align = "left">       
        <h3>Welcome to Better Eats! <br/>
        <small>Discover and share recipes that only use ingredients found in the dining halls.</small></h3>
    </section>

    <section class="seven columns" align = "center" >
        <?php foreach($rows as $row)
        {
            print("<div class='row'>
                <div class='nine columns'>
                    <p><a href='#' data-reveal-id='recipe".$row["id"]."' class='button'>" . htmlspecialchars($row["title"]) . "</a></p>
                    <p>" . htmlspecialchars($row["description"]) . "</p></div><hr/>
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
    </section>

    <section class="two columns" >
        <form method="GET" action="index.php" name="searchForm">
            <input type="text" name="search" placeholder="Search" value="<?php echo isset($searchTerms)?htmlspecialchars($searchTerms):''; ?>" />
            <input type="submit" name="submit" value="Search!" />
        </form>
    </section>
</div>
<hr/>


