<!-- header to be shown at top of all pages -->

<?php
    // store tags from txt file into array
    $tfile = 'tags.txt';
    $thandle = fopen($tfile, 'r');
    if ($thandle)
    { 
        $tags = explode("\n", trim(fread($thandle, filesize($tfile)))); 
    }
    fclose($thandle);
?>

<!DOCTYPE html>

<html>

    <head>

        <link rel="stylesheet" href="css/foundation.min.css">
        <link rel="stylesheet" href="css/app.css">

        <?php if (isset($title)): ?>
            <title>Better Eats: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Better Eats</title>
        <?php endif ?>

        <!-- includes javascript files that we are using -->
        <script src="js/modernizr.foundation.js"></script>
        <script src="js/foundation.min.js"></script>
        
    </head>

    <body>
    
        <div class="row">
            <!-- navigation bar -->
            <nav class="top-bar">
                <section>
                    <ul class="right">
                        <li class="divider"></li>
                        <li class="has-dropdown"><a href="/">browse recipes</a>
                            <ul class="dropdown">
                                <li><label>Tags</label></li>
                                <?php foreach($tags as $tag)
                                    print('<li><a href="/index.php?search=' . $tag . '&submit=Search%21">' . $tag . '</a></li>');
                                ?>
                            </ul>
                        </li>
                        <li class="divider"></li>
                        <li><a href="/recipe.php">submit a recipe</a></li>
                        <li class="divider"></li>
                        <li><a href="/contact.php">contact us</a></li>
                    </ul>
                </section>
            </nav>

                        
            <!-- bar with logo -->
            <a href="/"><img alt="Better Eats" src="img/logo.jpg"/></a>
            See dining halls in a new way.
            <hr/>
        </div>
        
        <div id="middle">

