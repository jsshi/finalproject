<!-- Displays the home page of the website -->

<div class="row">
    <section class="three columns" align = "left">       
        <h3>Welcome to Better Eats! <br/>
        <small>Discover and share recipes that only use ingredients found in the dining halls.</small></h3>
    </section>

    <section class="seven columns" align = "center" >
        <?php
            $perpage = 10;
            
            $numrows = count($rows);
            
            $last = ceil($numrows / $perpage);
            
            if (isset($_GET['page']))
                $page = $_GET['page'];
            if ($page < 1)
                $page = 1;
                
            $start = ($page - 1) * $perpage;
            $end = $start + $perpage - 1;
            
            if ($end > $numrows - 1)
                $end = $numrows - 1;
                
            if ($page == 1)
                echo "<< FIRST  < PREV ";
            else
            {
                $prevpage = $pageno - 1;
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
                echo " <a href='?page=$lastpage'>LAST >></a> ";
            }
        echo "<p>";
        
        for($i = $start; $i <= $end; $i++)
        {
            print("<div class='row'>
                <div class='twelve columns'>
                    <p><a href='#' data-reveal-id='recipe".$rows[$i]["id"]."' class='button'>" . htmlspecialchars($rows[$i]["title"]) . "</a></p>
                    <p>" . htmlspecialchars($rows[$i]["description"]) . "</p></div><hr/>
            </div>
            <div id='recipe".$rows[$i]["id"]."' class='reveal-modal'>
                <h3>" . htmlspecialchars($rows[$i]["title"]) . "</h3>
                <p><i>" . htmlspecialchars($rows[$i]["description"]) . "</i></p>
                <p>" . $rows[$i]["ingredients"] . "</p>
                <p>" . htmlspecialchars($rows[$i]["instructions"]) . "</p>
                <p>" . $rows[$i]["tags"] . "</p>
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


