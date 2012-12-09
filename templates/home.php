<!-- Displays the home page of the website -->

<!-- Info section on left side of page -->
<div class="row">
    <section class="three columns" align = "left">       
        <h3>Welcome to Better Eats! <br/>
        <small>Discover and share recipes that only use ingredients found in the dining halls.</small></h3>
    </section>

    <section class="seven columns" align = "center" >
        <?php
            // sets up page navigation
            $perpage = 10;
            $numrows = count($rows);
            $last = ceil($numrows / $perpage);
            
            // determines which page user is on
            if (isset($_GET['page']))
                $page = $_GET['page'];
            if ($page < 1)
                $page = 1;
               
            // defines start and end recipes 
            $start = ($page - 1) * $perpage;
            $end = $start + $perpage - 1;
            
            if ($end > $numrows - 1)
                $end = $numrows - 1;
            
            // adds page navigation links
            if ($page == 1)
                echo "<< FIRST  < PREV ";
            else
            {
                $prevpage = $page - 1;
                echo " <a href='?page=1'> << FIRST</a> ";
                echo "  <a href='?page=$prevpage'> < PREV</a> ";
            }
            
            echo " ( Page $page of $last ) ";
            
            if ($page == $last)
                echo " NEXT >  LAST >> ";
            else
            {
                $nextpage = $page + 1;
                echo " <a href='?page=$nextpage'>NEXT ></a>  ";
                echo " <a href='?page=$last'>LAST >></a> ";
            }
            echo "<p></p>";
            
            // loops through recipes on that page
            for($i = $start; $i <= $end; $i++)
            {
                // prints title (in a button) and description
                print("<div class='row'>
                    <div class='twelve columns'>
                        <p><a href='#' data-reveal-id='recipe".$rows[$i]["id"]."' class='button'>" . htmlspecialchars($rows[$i]["title"]) . "</a></p>
                        <p>" . htmlspecialchars($rows[$i]["description"]) . "</p>
                        <p><small>" . $rows[$i]["time"] . "</small></p></div><hr/>
                </div>"
                
                .// includes information to be shown in button
                "<div id='recipe".$rows[$i]["id"]."' class='reveal-modal'>
                    <h3>" . htmlspecialchars($rows[$i]["title"]) . "</h3>
                    <p><b>Description: </b><i>" . htmlspecialchars($rows[$i]["description"]) . "</i></p>
                    <p><b>Ingredients: </b>" . $rows[$i]["ingredients"] . "</p>
                    <p><b>Instructions: </b>" . htmlspecialchars($rows[$i]["instructions"]) . "</p>
                    <p><b>Tags: </b>" . $rows[$i]["tags"] . "</p>
                <a class='close-reveal-modal'>x</a></div>");
            }
        ?>
    </section>

    <!-- search bar -->
    <section class="two columns" >
        <form method="GET" action="index.php" name="searchForm">
            <input type="text" name="search" placeholder="Search" value="<?php echo isset($searchTerms)?htmlspecialchars($searchTerms):''; ?>" />
            <input type="submit" name="submit" value="Search!" />
        </form>
    </section>
</div>
<hr/>
