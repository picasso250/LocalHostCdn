<?php
/**
 * router
 */

require '../autoload.php';

$searcher = new FileSearcher;
$url = $_SERVER['HOST'].$_SERVER['REQUEST_URI'];
$path = $searcher->getPath($url);
if (!file_exists($path)) {
} else {
    $cacher = new Cacher($url);
    $path = $cacher->getPath();
}
$output = new Output();
$output->output($path);
