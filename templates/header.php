<!DOCTYPE html>

<html>

    <head>

        <link rel="stylesheet" href="css/foundation.min.css">

        <?php if (isset($title)): ?>
            <title>Better Eats: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Better Eats</title>
        <?php endif ?>

        <script src="js/modernizr.foundation.js"></script>
        <script src="js/foundation.min.js"></script>

    </head>

    <body>

        <div class="container-fluid">

            <div id="top" class="twelve columns">
                <a href="/"><img alt="Better Eats" src="img/logo.jpg"/></a>
                See dining halls in a new way.
                <ul class="nav-bar">
                    <li><a href="/">browse recipes</a></li>
                    <li><a href="/recipe.php">submit a recipe</a></li>
                </ul>
                
            </div>

            <div id="middle">

