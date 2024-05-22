<?php

$path = pathinfo($_SERVER["REQUEST_URI"]);
$filepath = __DIR__ . $path['dirname'] . '/' . $path['basename'];

if (preg_match('/^(\/css|js|)/', $path['dirname'])) {
    return false;
} elseif (isset($path['extension']) && $path['extension'] == 'php') {
    require  __DIR__ .  '../' . $filepath;
    return true;
} else {
    $_SERVER['APP_DEBUG'] = 1;
    require  __DIR__ . '/index.php';
    return true;
}
