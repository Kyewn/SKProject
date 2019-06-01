<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "sk_projek";

$connection = new mysqli($servername, $username, $password, $db);
    if ($connection->connect_error){
    die("Connection failed: " . $connection->connect_error);
}

if(isset($_POST['update'])){ 
    $total = count($_POST['namaalat']);
    $kodalat_arr = $_POST['kodalat'];
    $namaalat_arr = $_POST['namaalat']; 
    $bilalat_arr = $_POST['bilalat'];
    $jenisalat_arr = $_POST['jenisalat']; 
    for($i = 0; $i < $total; $i++){
        $kodalat = str_replace("P", "",  $kodalat_arr[$i]);
        $namaalat = $namaalat_arr[$i]; 
        $bilalat = $bilalat_arr[$i]; 
        $jenisalat = $jenisalat_arr[$i];
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
?>