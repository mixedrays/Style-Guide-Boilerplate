<?php include_once('functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Style Guide Boilerplate</title>
    <meta name="viewport" content="width=device-width">

    <!-- Vendor styles   -->
    <link rel="stylesheet" href="css/vendor/prism.css">

    <!-- Style Guide Boilerplate Styles -->
    <link rel="stylesheet" href="css/sg-styles.css">

    <!-- Replace below stylesheet with your own stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="sg-body">
    <div id="top" class="sg-header sg-container">
        <h1 class="sg-logo">STYLE GUIDE <span>BOILERPLATE</span></h1>
    </div>

    <div class="sg-sidebar">
        <div class="sg-sidenav">
            <?php listFolderFiles('markup') ?>
        </div>
    </div>

    <div class="sg-main-section sg-container">
        <?php renderFolderFiles('markup'); ?>
    </div>

    <script src="js/vendor/prism/prism.js"></script>
    <script src="js/sg-scripts.js"></script>
</body>
</html>

