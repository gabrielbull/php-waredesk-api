<?php

require_once __DIR__ . '/../vendor/autoload.php';
if (file_exists(__DIR__.'/files/accessToken.txt')) {
    unlink(__DIR__.'/files/accessToken.txt');
}
