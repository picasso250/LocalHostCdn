<?php

$local = new \local\Local;
$url_list = $local->check();
foreach ($url_list as $url) {
    $content = $local->getViaPorxy($url);
    $local->save($url, $content);
}
