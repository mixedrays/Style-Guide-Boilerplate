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
        <h1 class="sg-h1 sg-logo">STYLE GUIDE <span>BOILERPLATE</span></h1>
    </div>

    <div class="sg-clearfix">
        <div class="sg-sidebar sg-nav sg-container">
            <h1 class="sg-h1">Navigation</h1>
            <?php listFolderFiles('markup') ?>
        </div>

        <div class="sg-main-section sg-container">
            <?php renderFolderFiles('markup'); ?>
        </div>
    </div>

    <a href="#top" class="sg-btn sg-btn--top" title="Scroll to top">Top</a>

    <script src="js/vendor/prism/prism.js"></script>
    <script src="js/sg-scripts.js"></script>
</body>
</html>

