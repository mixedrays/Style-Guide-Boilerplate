<?php include_once('functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Style Guide Boilerplate</title>
    <meta name="viewport" content="width=device-width">

    <!-- Style Guide Boilerplate Styles -->
    <link rel="stylesheet" href="css/sg-styles.css">

    <!-- Replace below stylesheet with your own stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header id="top" class="sg-header sg-container">
        <h1 class="sg-logo">STYLE GUIDE <span>BOILERPLATE</span></h1>
    </header>

    <aside class="sg-sidebar">
        <nav class="sg-sidenav">
            <?php listFolderFiles('markup') ?>
        </nav>
    </aside>

    <section class="sg-main-section sg-container">
        <?php renderFolderFiles('markup'); ?>
    </section>

    <script src="js/sg-plugins.js"></script>
    <script src="js/sg-scripts.js"></script>
</body>
</html>

