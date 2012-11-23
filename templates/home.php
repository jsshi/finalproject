<!-- Displays the home page of the website -->
<hr/>
<div class="row">
    <div class="twelve columns">
        <center>
            <h3>Welcome to Better Eats! <br/>
            <small>Discover and share recipes that only use ingredients found in the dining halls.</small></h3>
        </center>
    </div>
</div>
<hr/>

<?php foreach($rows as $row)
    print("<div class='row'>
        <div class='nine columns'>
            <p><a href='#' data-reveal-id='recipe' class='button'>" . $row["name"] . "</a></p>
            <p>" . $row["description"] . "</p>
        </div><hr/>
    </div>");
?>
  
<?php foreach($rows as $row)
    print("<div id='recipe' class='reveal-modal'>
        <h3>" . $row["name"] . "</h3>
        <p><i>" . $row["description"] . "</i></p>
        <p>" . $row["ingredients"] . "</p>
        <p>" . $row["instructions"] . "</p>
        <p>" . $row["tags"] . "</p>
   <a class='close-reveal-modal'>x</a></div>");
?>
