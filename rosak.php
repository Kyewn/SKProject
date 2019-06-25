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
    <link rel="stylesheet" type="text/css" href="rosak.css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aldrich" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bai+Jamjuree" rel="stylesheet">
</head>
<script type="text/javascript">
function validateJenis() {
    var select = document.getElementById("jenisrosak");
    var selectVal = "";
    if (select) {
        selectVal = select.value;
    }
    var murid = document.getElementById("murid");
    var muridVal = "";
    if (murid) {
        muridVal = murid.value;
    }

    if (selectVal != "buatan pelajar") {
        if (muridVal != "") {
            alert('Jenis kerosakan bukan buatan pelajar!');
            return false;
        }
    } else if (selectVal == "buatan pelajar") {
        if (muridVal == "") {
            alert('Pastikan anda merekod ID murid!');
            return false;
        }
    } else {
        return true;
    }
}
</script>
<?php
$servername = "localhost";
$user = "root";
$password = ""; 
$db = "sk_projek";

$connection = new mysqli($servername, $user, $password, $db);
if ($connection->connect_error){
    die("Connection failed: " . $connection->connect_error);
}

$alat = $bil = $jenis = $murid = $pendaftar = "";
$tarikh = date("d/m/Y");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $alat = text_input($_POST["namaalat"]);
        $bil = text_input($_POST["bilalat"]);
        isset($jenis)? $jenis = text_input($_POST["jenisrosak"]) : $jenis = "placeholder";
        $tarikh = text_input($_POST["tarikhrosak"]);
        $murid = text_input($_POST["murid"]);
        $pendaftar = text_input($_POST["pendaftar"]);
        $query123 = "SELECT * FROM peralatan WHERE NAMAALAT = '$alat'";
        $res123 = mysqli_query($connection, $query123);
    
    if (empty($alat)) {
        echo "<script>alert('Pastikan input diisi!');</script>";
    } else if (empty($bil)) {
        echo "<script>alert('Pastikan input diisi!');</script>";    
    } else if (empty($jenis)) {
        echo "<script>alert('Pastikan input diisi!');</script>";
    } else if (empty($tarikh)) {
        echo "<script>alert('Pastikan input diisi!');</script>";
    } else if (!mysqli_num_rows($res123)) {
        echo "<script>alert('Alat yang tidak wujud dalam pangkalan data!');</script>";
    } else if (!preg_match('/^[0-9]+$/', $bil)) {
        echo "<script>alert('Bilangan alat bukan jenis nombor!');</script>";    
    } else if ($jenis == "placeholder"){
        echo "<script>alert('Jenis kerosakan perlu dijelaskan!');</script>";
    } else if (!preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $tarikh)){
        echo "<script>alert('Tarikh bukan dalam format tarikh!');</script>";
    } else {
        $query = "INSERT INTO kerosakan (NAMA_ALAT, BIL_ALAT, JENIS_ROSAK, TARIKH_ROSAK, MURID_TERLIBAT, PEREKOD)
             VALUES ('$alat','$bil', '$jenis', '$tarikh', '$murid', '$pendaftar')";
        mysqli_query($connection, $query);
        $query2 = "SELECT * FROM kerosakan WHERE NAMA_ALAT = '$alat'";  
        $result = mysqli_query($connection, $query2);
        if (!$result) {
            echo "<script>alert('Gagal merekod kerosakan! Cuba lagi.');</script>";
            } else {
                echo "<script>alert('Berjaya merekod kerosakan!');</script>";
            }
        }
    mysqli_close($connection);
}

function text_input($data){
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = strtolower($data);
    return $data;
}    
?>
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
        <div class="first">        
            <h1><span style="color:#fcf37a;">R</span>ekod <span style="color: #ff9431;">K</span>erosakan</h1>
            <p>Sila <span style="color: #fcf37a;">menyemak</span><span style="color: #ff9431;"> sekali</span> butiran anda sebelum<br />merekod ke pangkalan data!</p>
        </div>
        <form id="form" method="POST" onsubmit="return validateJenis();" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <div>
            <label for="nama">Nama alat</label><br />
            <input type="text" id="namaalat" name="namaalat" value="<?php echo isset($alat)? $alat : '';?>"><br /><br /><br />
                <label for="bilalat">Bilangan Alat</label><br />
                <input type="text" id="bilalat" name="bilalat" value="<?php echo isset($bil)? $bil : '';?>"><br /><br /><br />
                    <label for="jenisrosak">Jenis Kerosakan</label><br />
                    <select name="jenisrosak" id="jenisrosak">
                        <option <?php if ($jenis == "placeholder") echo 'selected';?> value="placeholder">Sila pilih satu:</option>
                        <option <?php if ($jenis == "rosak sendiri") echo 'selected';?> value="rosak sendiri">Rosak sendiri</option>
                        <option <?php if ($jenis == "buatan pelajar") echo 'selected';?> value="buatan pelajar">Buatan pelajar</option>
                        <option <?php if ($jenis == "unsur luar") echo 'selected';?> value="unsur luar">Unsur luar</option>
                    </select><br /><br /><br />
                <label for="bilalat">Tarikh Rosak</label><br />
                <input type="text" id="tarikhrosak" name="tarikhrosak" value="<?php echo isset($tarikh)? $tarikh : date("d/m/Y");?>">
            </div>
            <div class="sec">
            <label for="murid">Murid Yang Terlibat</label><br />
            <input id="murid" name="murid" type="text"><br/><br/><br/>
                <label for="pendaftar">Pendaftaran Oleh</label><br />
                <input id="pendaftar" name="pendaftar" type="text" value="<?php echo isset($_COOKIE['username'])? $_COOKIE['username'] : '';?>" readonly>
                </form>
                <div class="buttons">
                    <button for="form">OK</button>
                    <a href="homepage.php"><button type="button">Balik</button></a>
                </div>
            </div>
        </div>
</body>
</html>