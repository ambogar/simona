<?php
require 'functions.php';

$id = $_GET["id"];

?>



<!doctype html>
<html lang="en">

<head>
  <title>UPLOAD FILE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="./dist/styles.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
    crossorigin="anonymous">
  <style>
  .login{
    background: url('./dist/images/login-new.jpeg')
  }
  </style>  
</head>

<body class="h-screen font-sans login bg-cover">
<div class="container mx-auto h-full flex flex-1 justify-center items-center">
  <div class="w-full max-w-lg">
    <div class="leading-loose">
      <form class="max-w-xl m-4 p-10 bg-white rounded shadow-xl" action="" method ="post" enctype="multipart/form-data">
      <a href="index.php" class="bg-red-300 hover:bg-red-500 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center" >Back</a>
        <p class="text-gray-800 font-medium text-center text-lg font-bold">Upload File Disini</p>
            <input class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded" type="file" name="dokumen" id="dokumen" ></input>
            <button class="bg-blue-500 hover:bg-green-200 text-white font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-500 rounded" type="submit" name="submit" value="UPLOAD">UPLOAD</button>
            
      </form>
      <?php upload($id);?>
      

    </div>
  </div>
</div>
</body>

</html>
