<!DOCTYPE html>

<html>

    <head>

        <link rel="stylesheet" href="css/foundation.css">

        <?php if (isset($title)): ?>
            <title>Better Eats: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Better Eats</title>
        <?php endif ?>

        <script src="js/modernizr.foundation.js"></script>

    </head>

    <body>

        <div class="container-fluid">

            <div id="top">
                <a href="/"><img alt="Better Eats" src="img/logo.jpg"/></a>
            </div>

            <div id="middle">

