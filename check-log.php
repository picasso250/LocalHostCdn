<?php

// Usage: check-log <log-file>
// must in htdocs directory

$log_file = $argv[1];

$size = filesize($log_file);
$f = fopen($log_file, "r");
$offset = max(0, $size - 10000);
$r = fseek($f, $offset);

$cnt=0;
while ($line = fgets($f)) {
    $cnt++;
    if (preg_match('#"GET /(ajax/libs/jquery/([\d.]+)/jquery.min.js) HTTP/1.1" 404 \d+#', $line, $m)) {
        $version = $m[2];
        $url = "https://ajax.aspnetcdn.com/ajax/jQuery/jquery-$version.min.js";

        $path = $m[1];
        $dir = dirname($path);
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        if (!file_exists($path)) {
            echo "$path\n";
            $c = file_get_contents($url);
            file_put_contents($path, $c);
        }
    }
}

fclose($f);

error_log("check $log_file $cnt lines");