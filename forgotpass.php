<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ubah Kata Laluan</title>
    <link rel="icon" href="./images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="forgotpass.css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aldrich" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bai+Jamjuree" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>  
    <script src="forgotpassalert.js" type="text/javascript"></script> 
    <script src="generatequestion.js" type="text/javascript"></script>
</head>
<style>
.error{
    display: block;
    color: red;
    font-weight: bolder;
}

#question{
    font-weight: bolder;    
}
</style>
<script type="text/javascript">
$(document).ready( function() {
 $("#userid").keyup(function(){            
      $("#usererr").html("");             
  })                                     
                                        
  $("#pass").keyup(function(){         
      $("#passerr").html("");         
  })

  $("#confirmpass").keyup(function(){       
      $("#confirmpasserr").html("");       
  })

  $("#answer").keyup(function(){
      $("#answererr").html("");
  })
})
</script>
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
 
    $q = isset($_GET['q']) ? $_GET['q'] : '';

    mysqli_select_db($connection, "pengguna");
    $sql = "SELECT * FROM pengguna WHERE NAMA= '$q'";
    $result2 = mysqli_query($connection, $sql);

    if($q != ""){
        if($row = mysqli_fetch_array($result2)){
            $encoded = $row['SECURITYQ'];
            echo "$encoded";
            exit();
        } else {
            echo "";
            exit();
        }
    } else {
        echo "";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (empty($_POST["userid"])){
            $usererr = "Tiada input";
            } else {
            $userid = text_input($_POST["userid"]);
            }
            
            if (empty($_POST["pass"])){      
            $passerr = "Tiada input";
            } else {
            $pass = text_input($_POST["pass"]);
            }

            if (empty($_POST["confirmpass"])){
            $confirmpasserr = "Tiada input";
            } else {
            $confirmpass = text_input($_POST["confirmpass"]);
            }
            
            if (empty($_POST["answer"])){      
            $answererr = "Tiada input";
            } else {
            $answer= strtolower($_POST["answer"]);
            }
        //--------------------------------------------------
            $query = "SELECT * FROM pengguna WHERE NAMA='$userid'";
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);
            //Checks if user exist
            if(!$count){
                echo "<script>alert('Tidak mempunyai rekod pengguna tersebut dalam pangkalan data!');</script>";
            } else {
                $query2 = "SELECT * FROM pengguna WHERE NAMA = '$userid' and ANSWER = '$answer'";
                $result3 = mysqli_query($connection, $query2);
                $count2 = mysqli_fetch_array($result3);
                //checks if userid and answer matches
                if (!$count2) {
                    echo "<script>alert('Jawapan soalan sekuriti SALAH!');</script>";
                } else if ($pass !== $confirmpass){
                        echo "<script>alert('Kata laluan yang diinput tidak sama!');</script>";
                    } else if (empty($_POST["userid"])) {
                            $usererr = "Tiada input";
                        } else if (strlen($_POST["pass"]) < 6) {
                            echo "<script>alert('Kata laluan perlu sekurang-kurangnya 6 huruf!');</script>";
                        } else if (empty($_POST["pass"])) {
                            $passerr = "Tiada input";
                        } else if (empty($_POST["confirmpass"])) {
                            $confirmpasserr = "Tiada input";
                        }else if (empty($_POST["answer"])) {
                            $answererr = "Tiada input";
                        } else {
                                $updatepass = "UPDATE pengguna SET KATALALUAN = '$pass' WHERE NAMA = '$userid' and ANSWER = '$answer'";
                                mysqli_query($connection, $updatepass);
                                $updated = "SELECT * FROM pengguna WHERE NAMA = '$userid' and KATALALUAN = '$pass'";
                                $updatedResult = mysqli_query($connection, $updated);
                                $count3 = mysqli_fetch_array($updatedResult);                               
                                echo "<script>alert('Anda telah berjaya mengubah kata laluan anda!');
                                window.location.href='loginpage.php';</script>";
                                //checks if the new password is updated
                        if (!$count3){
                            echo "<script>alert('Tidak berjaya mengubah kata laluan anda! Cuba lagi.');</script>";
                         } 
                     }
                }
         mysqli_close($connection);
    }

function text_input($data){
    $data = strtolower($data);
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<body>
    <h1>Ubah Kata Laluan</h1>
    <p>Pastikan kata laluan anda tidak mempunyai huruf ganjil!</p>
    <div class="content">
    <form id="form" method="post" onsubmit="checkErr()" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <label for="userid">Nama Pengguna *</label>
        <input id="userid" type="text" name="userid" onchange="showQuestion(this.value)" value=<?php echo isset($userid)? $userid : ""?>>
        <span class="error" id="usererr"><?php echo $usererr;?></span><br/>
            <label for="newpass">Kata Laluan Baru *</label>
            <input id="pass" type="password" name="pass">
            <span class="error" id="passerr"><?php echo $passerr;?></span><br/>
                <label for="newpassconfirm">Pengiktirafan Kata Laluan Baru *</label>
                <input id="confirmpass" type="password" name="confirmpass">
                <span class="error" id="confirmpasserr"><?php echo $confirmpasserr;?></span><br/>
            <label for="question">Soalan Sekuriti</label><br /><br/>
            <span id="question" name="question" value="<?php echo isset($question)? $question : ''?>"><b></b></span><br /><br />
        <label for="answer">Jawapan</label>
        <input id="answer" type="text" name="answer" value=<?php echo isset($answer)? $answer : '';?>>
        <span class="error" id="answererr"><?php echo $answererr;?></span><br/>
    </form>
    </div>   
    <div class="buttons">
        <button form="form">Submit</button>
        <a href="loginpage.php"><button>Back</button></a>
    </div>
</body>
</html>