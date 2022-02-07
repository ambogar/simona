<?php

require 'functions.php';

// Get id
$id = $_GET["id"];

mysqli_query($conn,"UPDATE apm SET acc='Belum ACC' WHERE id=$id");

 
// Redirecting back
header("Location: " . $_SERVER["HTTP_REFERER"]);


?>