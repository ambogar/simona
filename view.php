<?php

require 'functions.php';

// Store the file name into variable
$file = $_GET["view"];
$filepath = "uploads/".$file;
// Header content type
header("Content-type: application/pdf");
// Send the file to the browser.
readfile($filepath);


?>