<?php

require 'functions.php';

// Built-in PHP function to delete file
$filename = $_GET["name"];

delete($filename);
unlink("uploads/$filename");



 
// Redirecting back
header("Location: " . $_SERVER["HTTP_REFERER"]);


?>