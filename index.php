<?php
// Redirect to /public if accessed from root
if ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/index.php') {
    header("Location: /public/", true, 301);
    exit;
}
