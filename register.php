<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pengguna Baru</title>
    <link rel="icon" href="./images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="register.css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aldrich" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bai+Jamjuree" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<script type="text/javascript">
$(document).ready( function() {
 $("#namapengguna").keyup(function(){            
      $("#namaErr").html("");             
  })                                     
                                        
  $("#password").keyup(function(){         
      $("#passErr").html("");         
  })

  $("#confirmpass").keyup(function(){       
      $("#confirmpassErr").html("");       
  })

  $("#answer").keyup(function(){
      $("#answerErr").html("");
  })

  $("#question").keyup(function(){
      $("#questionErr").html("");
  })  
})
</script>
<?php 
$servername = "localhost";
$username = "root";
$password = "";
$db = "sk_projek";

$passErr = "Min: 6 huruf";
$namaErr = $confirmpassErr = $questionErr = $answerErr = "";
$nama = $pass = $confirmpass = $question = $answer = "";
$pattern = '/^(\+?6?01)[0|1|2|3|4|6|7|8|9]\-*[0-9]{7,8}$/';
 
$connection = new mysqli($servername, $username, $password, $db);
if ($connection->connect_error){
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $namaErr = $passErr = "";
    if (empty($_POST["namapengguna"])){
            $namaErr = "Tiada input";
        } else if (!ctype_alnum($_POST["namapengguna"])){
            $namaErr = "ID Pengguna mempunyai huruf ganjil!"; 
        } else {
        $nama = text_input($_POST["namapengguna"]);
        }
        
        if (empty($_POST["password"])){      
            $passErr = "Tiada input";
        } else if (!ctype_alnum($_POST["password"])){
            $passErr = "Kata Laluan mempunyai huruf ganjil!";
        } else {
        $pass = text_input($_POST["password"]);
        }

        if (empty($_POST["confirmpass"])){      
            $confirmpassErr = "Tiada input";
        } else if (!ctype_alnum($_POST["confirmpass"])){
            $confirmpassErr = "Kata Laluan mempunyai huruf ganjil!";
        } else {
        $confirmpass = text_input($_POST["confirmpass"]);
        }

        $telefon = $_POST["telefon"];

        if (empty($_POST["answer"])){      
            $answerErr = "Tiada input";
         } else {
            $answer = $_POST["answer"];
        }                                                               

        if (empty($_POST["question"])){      
            $questionErr = "Tiada input";
        } else { 
            $question = $_POST["question"];
        }                  

        $query3 = "SELECT * FROM pengguna WHERE NAMA = '$nama'";
        $res = mysqli_query($connection, $query3); 
        $rows = mysqli_fetch_array($res);
        if ($rows > 0) {
            echo "<script>alert('Pengguna tersebut sudah wujud!');</script>";
        } else {
        if ($pass !== $confirmpass){
            echo "<script>alert('Kata laluan yang diinput tidak sama!');</script>";
        } else if (!preg_match($pattern, $telefon) && !empty($_POST["telefon"])){
                echo "<script>alert('Nombor yang diinput bukan nombor telephone!');</script>";
            } else if (empty($_POST["namapengguna"])) {
                $namaErr = "Tiada input";
                echo "<script>alert('Pastikan kotak input yang wajib diisi!');</script>";
            } else if (!ctype_alnum($_POST["namapengguna"])){
                $namaErr = "Nama pengguna mempunyai huruf ganjil!";
            } else if (empty($_POST["password"])) {
                $passErr = "Tiada input";
                echo "<script>alert('Pastikan kotak input yang wajib diisi!');</script>";
            } else if (strlen($_POST["password"]) < 6) {
                echo "<script>alert('Kata laluan perlu sekurang-kurangnya 6 huruf!');</script>";
            } else if (!ctype_alnum($_POST["password"])){
                $passErr = "Kata Laluan mempunyai huruf ganjil!";
            } else if (empty($_POST["confirmpass"])) {
                $confirmpassErr = "Tiada input";
                echo "<script>alert('Pastikan kotak input yang wajib diisi!');</script>";
            } else if (!ctype_alnum($_POST["confirmpass"])){
                $confirmpassErr = "Kata Laluan mempunyai huruf ganjil!";
            } else if (empty($_POST["answer"])) {
                $answerErr = "Tiada input";
                echo "<script>alert('Pastikan kotak input yang wajib diisi!');</script>";
            } else if (empty($_POST["question"])){
                $questionErr = "Tiada input";
                echo "<script>alert('Pastikan kotak input yang wajib diisi!');</script>";
            } else {
            $query2 = "SELECT COUNT(*) FROM pengguna";
            $result2 = mysqli_query($connection,$query2);
            $result3 = mysqli_fetch_array($result2);
            if ($result3 > 0) {
                $id = 'U'. strval($result3['COUNT(*)'] + 1);
            }
            $query = "INSERT INTO pengguna (ID, NAMA, KATALALUAN, TELEFON, SECURITYQ, ANSWER)
                      VALUES ('$id', '$nama', '$pass', '$telefon', '$question', '$answer')";
            mysqli_query($connection, $query);
            $checkuser = "SELECT * FROM pengguna WHERE NAMA='$nama' and KATALALUAN='$pass'";
            $result = mysqli_query($connection, $checkuser);
            $count = mysqli_fetch_array($result);
            $checkid = "SELECT * FROM pengguna WHERE ID ='$id'";
            $idexist = mysqli_fetch_array(mysqli_query($connection, $checkid));
            echo "<script>alert('Berjaya mendaftar pengguna baru!');
                 window.location.href='loginpage.php';</script>";
            if(!$count){
                echo "<script>alert('Tidak berjaya mendaftar pengguna baru! Cuba lagi.');</script>";
                } 
            }
        }
        mysqli_close($connection);
    }

function text_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<style>
.error{
    font-weight: bolder;
    color: red;
    font-size: 13px;
}
</style>
<body>
    <h1>Pengguna Baru</h1>
    <p style="margin-bottom : 30px; font-size: 16px;">Ingat dan memastikan butiran anda betul sebelum anda daftar pengguna baru!</p>
    <div class="content">
    <form style="margin-bottom: 5px;" id="form" method="post" onsubmit="checkErr()" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <label for="namapengguna">Nama Pengguna *</label>
        <input type="text" name="namapengguna" id="namapengguna" value=<?php echo isset($nama)? $nama : '';?>>
        <span class="error" id="namaErr" name="namaErr"><?php echo $namaErr;?></span><br /><br />
            <label for="password">Kata Laluan *</label>
            <input type="password" name="password" id="password">
            <span class="error" id="passErr" name="passErr"><?php echo $passErr;?></span><br /><br />    
                <label for="confirmpass">Pengiktirafan Kata Laluan *</label>
                <input type="password" name="confirmpass" id="confirmpass">
                <span class="error" id="confirmpassErr" name="confirmpassErr"><?php echo $confirmpassErr;?></span><br /><br />    
                    <label for="telefon">Telefon (Opsyenal)</label>
                    <input type="text" name="telefon" id="telefon" placeholder="e.g. 0129876543"><br /><br />     
            <label for="question">Soalan Sekuriti *</label>
            <input type="text" name="question" id="question" value=<?php echo isset($question)? $question : ''?>>
            <span class="error" id="questionErr" name="questionErr"><?php echo $questionErr;?></span><br /><br />    
        <label for="answer">Jawapan *</label>
        <input type="text" name="answer" id="answer" value=<?php echo isset($answer)? $answer : '';?>>
        <span class="error" id="answerErr" name="answerErr"><?php echo $answerErr;?></span><br /><br />    
    </form>
    </div>   
    <div class="buttons">
        <button type="submit" form="form">Submit</button>
        <a href="loginpage.php"><button>Back</button></a>
    </div>
</body>
</html>