<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "sk_projek";

$connection = new mysqli($servername, $username, $password, $db);
    if ($connection->connect_error){
    die("Connection failed: " . $connection->connect_error);
}

//error_reporting(E_ERROR | E_WARNING | E_PARSE);

if(isset($_POST['update'])){ 
    $total = count($_POST['namaalat']);
    $kodalat_arr = $_POST['kodalat'];
    $namaalat_arr = $_POST['namaalat']; 
    $bilalat_arr = $_POST['bilalat'];
    $jenisalat_arr = $_POST['jenisalat']; 
    for($i = 0; $i < $total; $i++){
        $kodalat = strtolower(str_replace("P", "",  $kodalat_arr[$i]));
        $namaalat = strtolower($namaalat_arr[$i]); 
        $bilalat = strtolower($bilalat_arr[$i]); 
        $jenisalat = strtolower($jenisalat_arr[$i]);
        $query2 = "UPDATE peralatan SET `NAMAALAT`= '".$namaalat."', BILANGANALAT = '".$bilalat."', JENISALAT = '".$jenisalat."' WHERE KODALAT = '".$kodalat."'";                                     
        mysqli_query($connection, $query2);
        $query3 = "SELECT * FROM peralatan WHERE KODALAT='".$kodalat."' AND NAMAALAT = '".$namaalat."'";
        $result = mysqli_query($connection, $query3);
        $successful = mysqli_fetch_array($result);   //not firing alerts
        if($successful) {
            echo "<script>alert('Successful');</script>";
        } else {
            echo "<script>alert('Failed ');</script>";
        }
        header('location: kemaskini.php?database=peralatan');
    } 
    mysqli_close($connection);
}

if(isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $check = "SELECT * FROM peralatan WHERE KODALAT = '$id'";
    $checkres = mysqli_query($connection, $check);
    if(mysqli_num_rows($checkres) > 0){
        $query10 = "DELETE FROM peralatan WHERE KODALAT = '$id'";
        mysqli_query($connection, $query10);
        header("location: kemaskini.php?database=peralatan");
        echo "<script>alert('Berjaya delete data daripada pangkalan data!')</script>";
    } else {
        echo "<script>alert('Data sudah hilang daripada pangkalan data!')</script>";
    }
}

if(isset($_POST['update2'])){ 
    $total2 = count($_POST['namaalatr']);
    $kodrosak_arr = $_POST['kodrosak'];
    $namaalat_arr2 = $_POST['namaalatr']; 
    $bilalat_arr2 = $_POST['bilalatr'];
    $jenisrosak_arr = $_POST['jenisr'];
    $tarikhr_arr = $_POST['tarikhr'];
    $murid_arr = $_POST['perosak'];

    for($c = 0; $c < $total2; $c++){
        $kodrosak = strtolower(str_replace("KR", "",  $kodrosak_arr[$c]));
        $namaalat2 = strtolower($namaalat_arr2[$c]); 
        $bilalat2 = strtolower($bilalat_arr2[$c]); 
        $jenisr = strtolower($jenisrosak_arr[$c]);
        $tarikhr = strtolower($tarikhr_arr[$c]);
        $murid = strtolower($murid_arr[$c]);

        $query123 = "UPDATE kerosakan SET `NAMA_ALAT`= '".$namaalat2."', BIL_ALAT = '".$bilalat2."', JENIS_ROSAK = '".$jenisr."', TARIKH_ROSAK = '".$tarikhr."', MURID_TERLIBAT = '".$murid."' WHERE KOD_ROSAK = '".$kodrosak."'";                                     
        mysqli_query($connection, $query123);
        header('location: kemaskini.php?database=kerosakan');
    } 
    mysqli_close($connection);
}

if(isset($_POST['deleter'])) {
    $id2 = $_POST['deleter'];
    $check2 = "SELECT * FROM kerosakan WHERE KOD_ROSAK = '$id2'";
    $checkres2 = mysqli_query($connection, $check2);
    if(mysqli_num_rows($checkres2) > 0){
        $query120 = "DELETE FROM kerosakan WHERE KOD_ROSAK = '$id2'";
        mysqli_query($connection, $query120);
        header("location: kemaskini.php?database=kerosakan");
        echo "<script>alert('Berjaya delete data daripada pangkalan data!')</script>";
    } else {
        echo "<script>alert('Data sudah hilang daripada pangkalan data!')</script>";
    }
}

if(isset($_POST['csvsub'])){
    if (isset($_COOKIE['username'])) { 
        $user = $_COOKIE['username'];
    } else {
        $user = "NaN";
    }

    $filename = $_FILES['csv']['tmp_name'];

    if ($_FILES['csv']['size'] > 0) {
        $file = fopen($filename, 'r');
        while (!feof($file)){
            $data = fgetcsv($file, '0');
            $query3000 = "SELECT * FROM peralatan WHERE KODALAT='".$data[0]."'";
            $result3000 = mysqli_query($connection, $query3000);
            if (mysqli_num_rows($result3000) == 0) {
                $query321 = "INSERT INTO peralatan(NAMAALAT, BILANGANALAT, JENISALAT, PENDAFTAR)
                            VALUES('".$data[0]."', '".$data[1]."', '".$data[2]."', '".$user."')";
                mysqli_query($connection, $query321);

                echo "<script>window.alert('Rekod baru berjaya dimasukkan ke dalam pangkalan data!');
                     window.location = 'kemaskini.php?database=peralatan';</script>";
            }
        } fclose($file); 
    } else {
        echo "<script>window.alert('Rekod gagal dimasukkan ke dalam pangkalan data! Cuba lagi');
             window.location = 'kemaskini.php?database=peralatan';</script>";
    }
}

if(isset($_POST['csvsub2'])){
    if (isset($_COOKIE['username'])) { 
        $user1 = $_COOKIE['username'];
    } else {
        $user1 = "NaN";
    }

    $filename1 = $_FILES['csv2']['tmp_name'];

    if ($_FILES['csv2']['size'] > 0) {
        $file1 = fopen($filename1, 'r');
        while (!feof($file1)){
            $data1 = fgetcsv($file1, '0');
            $query30001 = "SELECT * FROM kerosakan WHERE KOD_ROSAK='".$data1[0]."'";
            $result30001 = mysqli_query($connection, $query30001);
            if (mysqli_num_rows($result30001) == 0) {
                $query3211 = "INSERT INTO kerosakan(NAMA_ALAT, BIL_ALAT, JENIS_ROSAK, TARIKH_ROSAK, MURID_TERLIBAT, PEREKOD)
                            VALUES('".$data1[1]."', '".$data1[2]."', '".$data1[3]."', '".$data1[4]."', '".$data1[5]."', '".$user1."')";
                mysqli_query($connection, $query3211);

                echo "<script>window.alert('Rekod baru berjaya dimasukkan ke dalam pangkalan data!');
                     window.location = 'kemaskini.php?database=kerosakan';</script>";
            }
        } fclose($file); 
    } else {
        echo "<script>window.alert('Rekod gagal dimasukkan ke dalam pangkalan data! Cuba lagi');
             window.location = 'kemaskini.php?database=kerosakan';</script>";
    }
}
//Simple update and delete functions done for both tables
?>

