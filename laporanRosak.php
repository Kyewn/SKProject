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
    <link rel="stylesheet" type="text/css" href="laporanRosak.css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aldrich" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bai+Jamjuree" rel="stylesheet">    
</head>
<!--Icons made by <a href="https://www.flaticon.com/authors/pixel-buddha" title="Pixel Buddha">Pixel Buddha</a> from <a href="https://www.flaticon.com/" 			    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" 			    title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a>-->
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
    <div class="content">
        <p>Laporan Kerosakan</p>
        <a href="laporan.php"><button type="button">Balik</button></a>
        <button class="cetak" type="button" onclick="window.print();">Cetak</button>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <select id="choice" name="choice">
                <option value="null"><?php echo isset($_POST['choice'])? 'Dipilih: KR'.$_POST['choice'] : "Pilih Kod: ";?></option>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $db = "sk_projek";
              
                $userid = $pass = $confirmpass = $question = $answer = "";
                $passerr = "Min: 6 huruf";
                $usererr = $confirmpasserr = $answererr = "";
              
                $connection = new mysqli($servername, $username, $password, $db);
                if ($connection->connect_error){
                    die("Connection failed: " . $connection->connect_error);
                }

                $query = "SELECT * FROM kerosakan";
                $res = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($res)){
                    echo "<option value='".strtolower($row['KOD_ROSAK'])."'>KR".$row['KOD_ROSAK']."</option>";
                }
                ?>
            </select>
            <input type="submit" id="submit" name="submit" value="Papar">
        </form>
        <div class="display">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $alat = $_POST['choice'];
            if ($alat == 'null') {
                echo "<p class='p'><img class='img' src='images/exclamation-mark.png' /><span>Tidak mempunyai data untuk dicetak!</span></p>";
            } else {
                $query = "SELECT * FROM kerosakan WHERE KOD_ROSAK = '$alat'";
                $res = mysqli_query($connection, $query);
                $query1 = "SELECT MURID_TERLIBAT FROM kerosakan WHERE KOD_ROSAK = '$alat'";
                if ($row = mysqli_fetch_assoc($res)){       
                    echo "<div class='first'>
                    <span>Kod Rosak:</span><p>KR".$row['KOD_ROSAK']."</p><br/><br/>
                    <span>Nama Alat Rosak:</span><p>".$row['NAMA_ALAT']."</p><br/><br/>
                    <span>Bilangan Alat Rosak:<p>".$row['BIL_ALAT']."</p></span><br/><br/>
                    <span>Jenis Rosak:<p>".$row['JENIS_ROSAK']."</p></span><br/><br/>
                    </div>
                    <div class='sec'>
                    <span>Tarikh Rosak:<p>".$row['TARIKH_ROSAK']."</p></span><br/><br/>
                    <span>Murid Terlibat:<p>".$row['MURID_TERLIBAT']."</p></span><br/><br/>
                    <span>Didaftarkan Oleh:<p>".$row['PEREKOD']."</p></span>
                    </div>"; //-$bilRosak
                }
            }
        }
        ?>  
        </div>
    </div>
</body>
</html>