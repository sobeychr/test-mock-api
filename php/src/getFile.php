<?php

function getFile($filepath) {
    $path = ROOT . 'data/' . $filepath;
    if(file_exists($path)) {
        return file_get_contents($path);
    }
    return null;
}
