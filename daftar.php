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
    <link rel="stylesheet" type="text/css" href="daftar.css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aldrich" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bai+Jamjuree" rel="stylesheet">    
    <script src="daftaralert.js" type="text/javascript"></script>
</head>
<?php
    $servername = "localhost";
    $user = "root";
    $password = "";
    $db = "sk_projek";

    $connection = new mysqli($servername, $user, $password, $db);
    if ($connection->connect_error){
        die("Connection failed: " . $connection->connect_error);
    }

    $nama = $bilangan = $jenis = $pendaftar = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (empty($_POST["namaalat"])){
            $nama = "";
        } else {
            $nama = text_input($_POST["namaalat"]);
        }

        if (empty($_POST["bilalat"])){
            $bilangan = "";
        } else {
            $bilangan = text_input($_POST["bilalat"]);
        }

        if (empty($_POST["jenisalat"])){
            $jenis = "";
        } else {
            $jenis = text_input($_POST["jenisalat"]);
        }

        if (isset($_POST['pendaftar'])) {
            $pendaftar = text_input($_POST["pendaftar"]);
        }

        $exist = "SELECT * FROM peralatan WHERE NAMAALAT= '$nama'";
        $queryit = mysqli_query($connection, $exist);
        $result = mysqli_num_rows($queryit);
        if (!preg_match('/^[0-9]+$/', $bilangan)){
            if (!empty($_POST['bilalat'])){
            echo "<script>alert('Bilangan alat bukan jenis nombor!');</script>";
            }
        } else if ($result > 0){
            echo "<script>alert('Alat tersebut sudah wujud dalam pangkalan data!');</script>";    
        } else if ($jenis == "placeholder") {
            echo "<script>alert('Jenis alat tidak diberikan!');</script>";
        } else {
            $daftar = "INSERT INTO peralatan (NAMAALAT, BILANGANALAT, JENISALAT, PENDAFTAR)
                      VALUES ('$nama', '$bilangan', '$jenis', '$pendaftar')";
            mysqli_query($connection, $daftar);
            echo "<script>alert('Berjaya mendaftar peralatan baru!');</script>";
            $query = "SELECT * FROM peralatan WHERE NAMAALAT = '$nama'";
            $result5 = mysqli_fetch_array(mysqli_query($connection, $query));   
            if (!$result5) {
                echo "<script>alert('Gagal mendaftar peralatan baru! Cuba lagi.');</script>";
            }
        }
        mysqli_close($connection);
    }

function text_input($data){
    $data = strtolower($data);
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
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
            <h1><span style="color:#45062E;">D</span>aftar <span style="color: #7F055F;">P</span>eralatan</h1>
            <p>Sila <span style="color: #45062E;">menyemak</span><span style="color: #7F055F;"> sekali</span> butiran anda sebelum<br />mendaftar ke pangkalan data!</p>
        </div>
        <form id="form" method="POST" onsubmit="checkErr()" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <label for="nama">Nama Alat</label><br />
            <input type="text" id="namaalat" name="namaalat"><br /><br /><br />
                <label for="bilalat">Bilangan Alat</label><br />
                <input type="text" id="bilalat" name="bilalat"><br /><br /><br />
                    <label for="jenisalat">Jenis Alat</label><br />
                    <select  name="jenisalat" id="jenisalat">
                        <option value="placeholder">Sila pilih satu: </option>
                        <option value="radas">Radas</option>
                        <option value="bahan">Bahan</option>
                        <option value="peralatanbiasa">Peralatan Biasa</option>
                    </select><br /><br /><br />
            <label for="pendaftar">Pendaftaran Oleh</label><br /> 
            <input id="pendaftar" name="pendaftar" type="text" value="<?php echo isset($_COOKIE['username'])? $_COOKIE['username'] : '';?>" readonly>
        </form>
        <div class="buttons">
            <button form="form">OK</button>
            <a href="homepage.php"><button>Balik</button></a>
        </div>
    </div>
</body>
</html>