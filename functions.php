<?php

// Build out URI to reload from form dropdown
// Need full url for this to work in Opera Mini
$pageURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";

if (isset($_POST['sg_uri']) && isset($_POST['sg_section_switcher'])) {
    $pageURL .= $_POST[sg_uri] . $_POST[sg_section_switcher];
    $pageURL = htmlspecialchars(filter_var($pageURL, FILTER_SANITIZE_URL));
    header("Location: $pageURL");
}

function listFolderFiles($dir)
{
    $files = scandir($dir);
    sort($files);

    echo '<ul>';
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $path = $dir . '/' . $file;

            echo '<li>';

            $filename = preg_replace("/\.html$/i", "", $file);
            $title = preg_replace("/\-/i", " ", $filename);
            echo '<a href="#sg-' . $filename . '">' . $title . '</a>';

            if (is_dir($path)) {
                listFolderFiles($path);
            }
            echo '</li>';
        }
    }
    echo '</ul>';
}

// Recursively render files in specified directory
function renderFolderFiles($dir)
{
    $files = scandir($dir);
    sort($files);

    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $path = $dir . '/' . $file;

            if (is_dir($path)) {
                renterTitleFromPath($path);
                renderFolderFiles($path);
            } else {
                renderFile($path);
            }
        }
    }
}

function renderFile($path)
{
    $content = file_get_contents($path);
    echo '<section class="sg-section">';
    renterTitleFromPath($path);
    renderFileDescription($content);

    $content = removeHtmlComments($content);
    renderFileExample($content);
    renderFileSource($content);
    echo '</section>';
}

function renterTitleFromPath($path)
{
    $nestingDepth = (substr_count($path, '/') > 6) ? 6 : substr_count($path, '/');
    $file = basename($path);
    $filename = preg_replace("/\.html$/i", "", $file);
    $title = preg_replace("/\-/i", " ", $filename);

    echo '<h' . $nestingDepth . ' id="sg-' . $filename . '" class="sg-title sg-anchor">' . $title . '</h' . $nestingDepth . '>';
}

function renderFileDescription($content)
{
    $pattern = '/<!--(.*)-->/Uis';
    preg_match_all($pattern, $content, $matches);

    if (!empty($matches[1])) {
        echo '<div class="sg-section-description">';
        foreach ($matches[1] as $match) {
            echo($match);
            echo '<br />';
        }
        echo '</div>';
    }
}

function renderFileExample($content)
{
    echo '<div class="sg-section-example">';
    echo $content;
    echo '</div>';
}

function renderFileSource($content)
{
    echo '<div class="sg-section-source">';
    echo '<pre>';
    echo '<code>';
    echo htmlspecialchars($content);
    echo '</code>';
    echo '</pre>';
    echo '</div>';
}

function removeHtmlComments($content = '')
{
    $content = preg_replace('/<!--(.*)-->/Uis', '', $content);
    $content = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $content);
    return $content;
}

?>
