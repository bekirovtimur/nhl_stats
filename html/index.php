<!DOCTYPE html>
<html lang="en">
<head>
  <title>Diploma work</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  </style>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">NHL Stats</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="index.php">Result</a></li>
      <li><a href="config.php">Config</a></li>
      <li><a href="dbtool.php">DB Update tool</a></li>
      <li><a href="#">About</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
<?php include 'content_result.php'; ?>
</div>
</body>
</html>

