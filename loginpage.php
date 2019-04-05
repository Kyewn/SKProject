<?php
    if(isset($_COOKIE["loggedin"])){
        header("location:homepage.php");
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
    <link rel="stylesheet" type="text/css" href="loginpage.css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aldrich" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bai+Jamjuree" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="loginpagealert.js" type="text/javascript"></script>
    <script>
    $(document).ready(function() {
    $("button.scrollbutton1").on('click', function(event) {
        var hash = $(this).attr("data-target");
        target = $("." + hash);
        event.preventDefault();
        $("html, body").animate({
        scrollTop: $(target).offset().top
      }, 480, function() {
        window.location.hash = hash;
      }
    );
  });

  $("#userid").keyup(function(){
      $("#usererr").html("");
  })

  $("#password").keyup(function(){
      $("#passerr").html("");
  })
});
    </script>
    </head>
<?php
//Connection
     $servername = "localhost";
     $username = "root";
     $password = "";
     $db = "sk_projek";
 
     $connection = new mysqli($servername, $username, $password, $db);
 
     
     $useridErr = $passwordErr = $norecord = "";
     $userid = $password = "";

     if ($connection->connect_error){
        die("Connection failed: " . $connection->connect_error);
    }
     
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (empty($_POST["userid"])){
        $useridErr = "Input Kosong";
        } else {
        $userid = text_input($_POST["userid"]);
        }
        
        if (empty($_POST["password"])){      
        $passwordErr = "Input Kosong";
        } else {
        $password = text_input($_POST["password"]);
        }

        $query = "SELECT * FROM pengguna WHERE NAMA='$userid' and KATALALUAN='$password'";
        $result = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result);   

        if ($count > 0){
            //successfully logged in
            $seconds = 86400 + time();
            setcookie(loggedin, date("F jS - g:i a"), $seconds);
            setcookie(username, $userid, $seconds);
            header("location:homepage.php");
        } else if (!$count){
            echo "<script>alert('Tidak mempunyai rekod pengguna tersebut dalam pangkalan data!')</script>";
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
    color: yellow;
    font-family: 'Alegreya Sans SC', sans-serif;
    font-size: 15px;
    font-weight: 600;
}

.error2{
    color: red;
    font-family: 'Alegreya Sans SC', sans-serif;
    font-size: 18px;
    font-weight: 600;
    
}
</style>
    <body>
        <div class="bg">
            <img src="./images/1200px-Clhs_Logo_HD.svg.png" alt="Chung Ling High School Logo" title="Chung Ling High School">
        </div>
        <div class="bottom">
            <div class="title">
                Sistem Pengurusan Peralatan <br  />di Makmal Sains
            </div>
            <button data-target="overflowed" class="scrollbutton1" type="button"><span>Log Masuk</span></button>
        </div>
        <div class="overflowed">
                <form id="login" method="post" onsubmit="checkErr()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <label for="userid">ID Pengguna</label>
                    <input id="userid" type="text" name="userid" style="text-align: center;" value=<?php echo isset($userid)? $userid : '' ?>>
                    <span id="usererr" class="error"><?php echo $useridErr;?></span> 
                    <label for="password">Kata Laluan</label>
                    <input id="password" type="password" name="password" style="text-align: center;">
                    <span id="passerr" class="error"><?php echo $passwordErr;?></span>
                </form>
                <div class="actionrow">
                    <a href="register.php">Pengguna Baru?</a>
                    <input type ="submit" form="login" value="Log Masuk">
                    <a href="forgotpass.php">Lupa Kata Laluan?</a>
                </div>
        </div>
    </body>   
</html>