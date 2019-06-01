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
    <link rel="stylesheet" type="text/css" href="kemaskini.css">
    <link href="https://fonts.googleapis.com/css?family=Alegreya+Sans+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aldrich" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bai+Jamjuree" rel="stylesheet">  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<!--<script type="text/javascript">
$(window).on("wheel", function(e) {
  focusedEl = document.activeElement;
  if (focusedEl.nodeName='input' && focusedEl.type && focusedEl.type.match(/number/i)){
    e.preventDefault();
    var max=null;
    var min=null;
    if(focusedEl.hasAttribute('max')){
      max = focusedEl.getAttribute('max');
    }
    if(focusedEl.hasAttribute('min')){
      min = focusedEl.getAttribute('min');
    }
        var value = parseInt(focusedEl.value, 10);
    if (e.originalEvent.deltaY < 0) {
      value++;
      if (max !== null && value > max) {
        value = max;
      }
    } else {
      value--;
      if (min !== null && value < min) {
        value = min;
      }
    }
    focusedEl.value = value;
    if (focusedEl.value == "") {
        focusedEl.value = 5;
    }
  }
});
</script>-->
<script type="text/javascript">
$(window).ready(function() {
$("tr input").dblclick(function() {
    if ($(this).attr('name') != 'kodalat[]'){
        if ($(this).attr('name') != 'pendaftar'){
            if ($(this).prop('readonly')) {
                $(this).prop('readonly', false)
                ;
            };
        };
    };
 });

$(window).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        event.preventDefault();
        return false;
    };
});

$("tr input").keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        if ($(this).prop('readonly')=== false) {
            $(this).prop('readonly', true);
        };
    };
  });
});
</script>
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
        <div class="menu">
            <?php error_reporting(E_ERROR | E_WARNING | E_PARSE);
            if ($_SERVER['REQUEST_METHOD'] == 'GET') $database = $_GET['database'];?>
            <form method="GET" class="choosedb" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <select id="database" name="database">
                    <option <?php if ($database == 'placeholder') echo 'selected';?> value="placeholder">Pilih pangkalan data:</option>
                    <option <?php if ($database == 'peralatan') echo 'selected';?> value="peralatan">Peralatan</option>
                    <option <?php if ($database == 'kerosakan') echo 'selected';?> value="kerosakan">Kerosakan</option>
                </select>
                <input type="submit" value="Papar">
            </form> 
            <div class="title">
                <span>Kemas kini Rekod</span><br/>
                <span class="two">Dwiklik untuk mengubahsuai data, <br />tekan Enter dalam ruangan data dan tekan OK untuk mengemaskini data</span>        
            </div>
            <!--buttons should be put inside form and sent to another php file 
            for processing(submitting changes)-->
            <form method="POST" id="alatdb" action="update.php">
            <div class="buttons">
                <button form="alatdb" type='submit' id='update' name='update'>OK</button>
                <a href="homepage.php"><button type="button">Balik</button></a>
            </div>
        </div>
        <div class="table">
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

            if ($_SERVER['REQUEST_METHOD'] == "GET"){
                $database = $_GET['database'];
                if ($database == 'placeholder'){
                    echo '<br/><br/><br/><br/><br/><br/><br/><br/><span style="margin: 38.5%; font-size:20px;">Tidak mempunyai data untuk dipapar</span>';        
                } else if ($database == 'peralatan'){           
                    if (isset($_GET['page'])){
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }

                    //$rowsDisplayed = 5;
                    //$startFrom = ($page-1)*$rowsDisplayed;
                    $alatdb = "SELECT * FROM peralatan"; //LIMIT $startFrom, $rowsDisplayed";
                    $query = mysqli_query($connection, $alatdb);
                    $getrows = mysqli_num_rows($query);
                    if ($getrows > 0){
                           /* echo "<form method='POST' action='search.php'><input type='text' id='searchbox' name='searchbox' class='searchbox' placeholder='Cari...'>
                                  <input type='submit' style='position: absolute; left: -9999px'/></form>";
                            echo "<form method='POST' action='limitrows.php'><input type='number' id='maxrows' name='maxrows' class='maxrows' min='5' max='25' value='5'>
                                  <input type='submit' style='position: absolute; left: -9999px'/></form>";
                            */echo "<table id='peralatan' border='1' style='border-collapse: collapse;'>
                            <tr>
                            <th></th>
                            <th>Kod Alat</th>
                            <th>Nama Alat</th>
                            <th>Bilangan Alat</th>
                            <th>Jenis Alat</th>
                            <th>Pendaftar</th>                     
                            </tr>";
        //We are now going to work on delete
                        while($row = mysqli_fetch_array($query)){
                            echo "<tr>";
                            //Icons made by <a href="https://www.flaticon.com/authors/pixelmeetup" title="Pixelmeetup">Pixelmeetup</a> from <a href="https://www.flaticon.com/" 			    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" 			    title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY
                            echo "<td><button type='submit' title='Delete' style='height: 35px; background-color: white; border: none; cursor: pointer;' name='delete' value='".$row['KODALAT']."'><img src='images/clear.png' style='width: 18px; margin: 50px; margin-top: 0; margin-bottom: 0;'/></button></td>";
                            echo "<td><input type='text' name='kodalat[]' value='P".$row['KODALAT']."' readonly='true'></td>";
                            echo "<td><input type='text' name='namaalat[]' value='".$row['NAMAALAT']."' readonly='true'></td>";
                            echo "<td><input type='number' name='bilalat[]' value='".$row['BILANGANALAT']."' readonly='true'></td>";
                            echo "<td><input type='text' name='jenisalat[]' value='".$row['JENISALAT']."' readonly='true'></td>";
                            echo "<td><input type='text' name='pendaftar' value='".$row['PENDAFTAR']."' readonly='true'></td>";
                            echo "</tr>";
                        }
                            echo "</table>
                            </form>";

                            echo "<div id='navbar'>";
                            $page_query = "SELECT * FROM $database";
                            $page_result = mysqli_query($connection, $page_query);
                            $total_rows = mysqli_num_rows($page_result);
                            $url = substr_replace("$_SERVER[REQUEST_URI]","",42);
                            
                            /*if ($total_rows > 5) {
                                if ($page > 1) {
                                    echo "<a href ='$url"."&page=".($page-1)."' class='prev'><<</a>";
                                }
                    
                                $pages = ceil($total_rows/$rowsDisplayed);
                                
                                for ($i=1;$i<$pages+1; $i++){
                                    if ($page == $i) {
                                    echo "<a href='$url"."&page=".$i."' class='currentpage'>".$i."</a>";
                                    } else {
                                    echo "<a href='$url"."&page=".$i."' class='pagination'>".$i."</a>";   
                                    }   
                                }

                                if ($page+1 < $i) {
                                    echo "<a href ='$url"."&page=".($page+1)."' class='next'>>></a>";
                                }
                            }
                            echo "</div>";
                            */
                    } else {
                            echo '<br/><br/><br/><br/><br/><br/><br/><br/><span style="margin: 38.5%; font-size:20px;">Tidak mempunyai data untuk dipapar</span>';
                    }
                }//for displaying peralatan (ending bracket)
                mysqli_close($connection);
            }
        ?>
    </div>
</body>
</html>