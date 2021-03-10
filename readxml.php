<?php
error_reporting(E_ALL);
error_reporting(E_ALL  & ~E_NOTICE & ~E_DEPRECATED & ~E_USER_DEPRECATED  & ~E_WARNING  );
ini_set('display_errors', true);

include "./include/functii.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>XML parsing data</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="./js/functii.js"></script>
</head>
<body>
<div class="container1">
    <center><h4>Parsare XML</h4></center>
    <?php  prelucreazadate();   ?>
</div>
</body>
</html>
  