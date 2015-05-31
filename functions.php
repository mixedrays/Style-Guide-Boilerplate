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
            renterTitleFromPath($path, false);

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

    echo '<div class="sg-section-group">';
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $path = $dir . '/' . $file;

            if (is_dir($path)) {
                renterTitleFromPath($path, true);
                renderFolderFiles($path);
            } else {
                renderFile($path);
            }
        }
    }
    echo '</div>';
}

function renderFile($path)
{
    $content = file_get_contents($path);
    echo '<div class="sg-section">';
    renderFileTitle($path);
    renderFileDescription($content);
    $content = removeHtmlComments($content);
    renderFileExample($content);
    renderFileSource($content);
    echo '</div>';
}

function renterTitleFromPath($path, $wrapHeader)
{
    $replaceInFilename = array(".html", ".scss", ".", " ");
    $nestingDepth = (substr_count($path, '/') > 6) ? 6 : substr_count($path, '/');
    $filename = str_replace($replaceInFilename, "", basename($path));
    $title = str_replace("-", " ", $filename);
    $id = $filename . $nestingDepth;

    if ($wrapHeader) {
        echo '<h' . $nestingDepth . ' id="sg-' . $id . '" class="sg-h' . $nestingDepth . ' sg-title">';
        echo '<a href="#sg-' . $id . '" class="sg-anchor">' . $title . '</a>';
        echo '</h' . $nestingDepth . '>';
    } else {
        echo '<a href="#sg-' . $id . '">' . $title . '</a>';
    }
}

function renderFileTitle($path)
{
    echo '<div class="sg-sub-section sg-section-title">';
    renterTitleFromPath($path, true);
    echo '</div>';
}

function renderFileDescription($content)
{
    $pattern = '/<!--(.*)-->/Uis';
    preg_match_all($pattern, $content, $matches);

    if (!empty($matches[1])) {
        echo '<div class="sg-sub-section sg-section-docs">';
        foreach ($matches[1] as $match) {
            echo($match);
            echo '<br />';
        }
        echo '</div>';
    }
}

function renderFileExample($content)
{
    echo '<div class="sg-sub-section sg-section-example">';
    echo $content;
    echo '</div>';
}

function renderFileSource($content)
{
    echo '<div class="sg-sub-section sg-section-source">';
    echo '<a class="sg-btn sg-btn--select" href="#" title="Select source code">Select</a>';
    echo '<pre>';
    echo '<code class="language-markup">';
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
