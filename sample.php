<?php 
    if(!isset($_COOKIE["loggedin"])){
        header("location: loginpage.php");
    }
?>
<!DOCTYPE html>
<html>
<head>    
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Pengurusan Peralatan di Makmal Sains</title>
    <link rel="icon" href="./images/favicon.png">
    <meta name="description" content="Sistem Pengurusan Peralatan di Makmal Sains CLHS.">
    <link rel="stylesheet" type="text/css" href="home.css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aldrich" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bai+Jamjuree" rel="stylesheet">    
</head>
<body>
    <div class="header">
        <a href="homepage.php">
        <img src="images/1200px-Clhs_Logo_HD.svg.png" alt="Chung Ling High School Logo" title="Chung Ling High School">
        <span class="span1">Sistem Pengurusan Peralatan di Makmal Sains</span>
        </a>
        <a href="logkeluar.php">
        <div class="logout">
            <span>&#171; &nbsp; Log Keluar</span>
        </div>
        </a>
    </div>
    <div class="divider"></div>
</body>
</html>