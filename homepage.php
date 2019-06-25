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
    <script type='text/javascript'>
    function setHalfVolume() {
        var myAudio = document.getElementById("audio");
        myAudio.volume = 0.5;
    }
    </script>    
</head>
<?php
$day = date("l");
if ($day == "Monday") {
    $day = "Isnin";
} else if ($day == "Tuesday"){
    $day = "Selasa";
} else if ($day == "Wednesday"){
    $day = "Rabu";
} else if ($day == "Thursday"){
    $day = "Khamis";
} else if ($day == "Friday"){
    $day = "Jumaat";
} else if ($day == "Saturday"){
    $day = "Sabtu";
} else if ($day == "Sunday"){
    $day = "Ahad";
}
?>
<body>
    <!--Song not made by me, Song source: Maplestory BGM Kerning Square-->
    <audio id='audio' autoplay onloadeddata="setHalfVolume()" loop>
        <source src='images\[MapleStory BGM] Kerning Square.mp3' type='audio/mp3'>
    </audio>
    <div class="header">
        <a href="homepage.php">
        <div>
        <img src="images/1200px-Clhs_Logo_HD.svg.png" alt="Chung Ling High School Logo" title="Chung Ling High School">
        <span class="span1">Sistem Pengurusan Peralatan di Makmal Sains</span>
        </div>
        </a>
        <a href="logkeluar.php">
        <div class="logout">
            <span>&#171; &nbsp; Log Keluar</span>
        </div>
        </a>
    </div>
    <!-- Credits to the creators of Maplestory Cursors of http://www.cursors-4u.com -->
    <div class="divider"></div>
    <div class="content">
        <div class="container1">
            <a class="first" href="daftar.php">Daftar Peralatan</a>
            <a class="second" href="rosak.php">Rekod Kerosakan</a>
            <a class="third" href="kemaskini.php">Kemaskini Rekod</a>
            <a class="fourth" href="laporan.php">Papar Laporan</a>
        </div>
        <script>
            var now = new Date(<?php echo time() * 1000 ?>);
            function startInterval(){  
                setInterval('updateTime();', 1000);  
            }
            startInterval();//start it right away
            function updateTime(){
                var nowMS = now.getTime();
                nowMS += 1000;
                now.setTime(nowMS);
                var clock = document.getElementById('clock');
                    if(clock){
                        var final = now.toTimeString().replace("GMT+0800 (Malaysia Time)", "");
                        clock.innerHTML = final + "<?php echo date(" A");?>";//adjust to suit
                    }
            } 
        </script>
        <div class="container2">
            <div class="words">
                <h1>Selamat Datang, <span style="color: rgb(253, 251, 109);"><?php echo isset($_COOKIE['username'])? $_COOKIE['username'] : '';?>!</span></h1><br />
                <p>Hari ini hari<br /><span style="font-size: 21.5px; color: rgb(253, 251, 109);"><?php echo $day;?>, <?php echo date("d/m/Y");?></span></p><br />
                <p>Masa Sekarang</br>
                <span id="clock" style="color: rgb(253, 251, 109); font-size: 40px; font-weight: bolder;"></span></p> 
        </div>
    </div>
</body>
</html>