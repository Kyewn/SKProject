<!DOCTYPE html>
<html>
<head>    
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Pengurusan Peralatan di Makmal Sains</title>
    <link rel="icon" href="./images/favicon.png">
    <meta name="description" content="Sistem Pengurusan Peralatan di Makmal Sains CLHS.">
    <link rel="stylesheet" type="text/css" href="logkeluar.css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aldrich" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bai+Jamjuree" rel="stylesheet">    
</head>
<?php 
    $loggedin = 'loggedin';
    $username = 'username';
    $seconds = -10 + time();
    setcookie($loggedin, date("F jS - g:i a"), $seconds);
    setcookie($username, "" , $seconds);
?>
<body>
    <div class="header">
        <div>
        <img src="images/1200px-Clhs_Logo_HD.svg.png" alt="Chung Ling High School Logo" title="Chung Ling High School">
        <span class="span1">Sistem Pengurusan Peralatan di Makmal Sains</span>
        </div>
    </div>
    <div class="divider"></div>
    <div class="content">
        <h1>Anda telah berjaya log keluar daripada sistem!</h1>
        <p>Pastikan anda telah menyemak semula maklumat dalam sistem sebelum ini!</p>
        <a href="loginpage.php"><button>Seterusnya</button></a>
    </div>
</body>
</html>