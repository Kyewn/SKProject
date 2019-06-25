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
    <script src="search.js" type="text/javascript"></script>
</head>
<script type="text/javascript">
$(window).ready(function() {
$("tr input").dblclick(function() {
    if ($(this).attr('name') != 'kodalat[]'){
        if ($(this).attr('name') != 'pendaftar[]'){
            if ($(this).attr('name') != 'kodrosak[]'){
                if ($(this).attr('name') != 'pendaftar2[]'){
            if ($(this).prop('readonly')) {
                $(this).prop('readonly', false)
                ;
            };
                };
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
            <form method="GET" name="choosedb" class="choosedb" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <select id="database" name="database">
                    <option <?php if ($database == 'placeholder') echo 'selected';?> value="placeholder">Pilih pangkalan data:</option>
                    <option <?php if ($database == 'peralatan') echo 'selected';?> value="peralatan">Peralatan</option>
                    <option <?php if ($database == 'kerosakan') echo 'selected';?> value="kerosakan">Kerosakan</option>
                </select>
                <input type="submit" id="papar" value="papar" />
            </form> 
            <div class="title">
                <span>Kemas kini Rekod</span><br/>
                <span class="two">Dwiklik untuk mengubahsuai data, <br />tekan Enter dalam ruangan data dan tekan OK untuk mengemaskini data</span>        
            </div>
            <!--buttons should be put inside form and sent to another php file 
            for processing(submitting changes)-->
            <div class="buttons">
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

            if (isset($_GET['database'])){
                $database = $_GET['database'];
                if ($database == 'placeholder'){
                    echo '<br/><br/><br/><br/><br/><br/><br/><br/><span style="margin: 38.5%; font-size:20px;">Tidak mempunyai data untuk dipapar</span>';        
                } else if ($database == 'peralatan'){           
                    $alatdb = "SELECT * FROM peralatan";
                    $query = mysqli_query($connection, $alatdb);
                    $getrows = mysqli_num_rows($query);
                    if ($getrows > 0){
                            echo "<form method='POST' action='update.php' enctype='multipart/form-data'>
                            <label class='csvstyle' for='csv'></label>
                            <input type='file' id='csv' name='csv'>
                            <input type='submit' id='csvsub' name='csvsub' class='csvsub' value='Import'/>
                            <input type='text' id='searchbox' name='searchbox' class='searchbox' onkeyup='search()' placeholder='Cari Nama...'>
                            <select id='pilih' nama='pilih'>
                            <option value='KodAlat'>Kod Alat</option>
                            <option value='NamaAlat'>Nama Alat</option>
                            <option value='BilAlat'>Bilangan Alat</option>
                            <option value='JenisAlat'>Jenis Alat</option>
                            <option value='Pendaftar'>Pendaftar</option>
                            </select>
                            </form>";
                            echo "<form method='POST' action='search.php'>
                                  
                                  </form>";
                            echo "<form method='POST' id='alatdb' action='update.php'>
                            <table id='peralatan' border='1' style='border-collapse: collapse;'>
                            <tr>
                            <th></th>
                            <th>Kod Alat</th>
                            <th>Nama Alat</th>
                            <th>Bilangan Alat</th>
                            <th>Jenis Alat</th>
                            <th>Pendaftar</th>                     
                            </tr>";
                        while($row = mysqli_fetch_array($query)){
                            echo "<tr>";
                            //Icons made by <a href="https://www.flaticon.com/authors/pixelmeetup" title="Pixelmeetup">Pixelmeetup</a> from <a href="https://www.flaticon.com/" 			    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" 			    title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY
                            echo "<td><button type='submit' title='Delete' style='height: 35px; background-color: white; border: none; cursor: pointer;' name='delete' value='".$row['KODALAT']."'><img src='images/clear.png' style='width: 18px; margin: 50px; margin-top: 0; margin-bottom: 0;'/></button></td>";
                            echo "<td><input type='text' name='kodalat[]' value='P".$row['KODALAT']."' readonly='true'></td>";
                            echo "<td><input type='text' name='namaalat[]' value='".$row['NAMAALAT']."' readonly='true'></td>";
                            echo "<td><input type='number' name='bilalat[]' value='".$row['BILANGANALAT']."' readonly='true'></td>";
                            echo "<td><input type='text' name='jenisalat[]' value='".$row['JENISALAT']."' readonly='true'></td>";
                            echo "<td><input type='text' name='pendaftar[]' value='".$row['PENDAFTAR']."' readonly='true'></td>";
                            echo "</tr>";
                        }
                            echo "</table>
                            </form>
                            <button form='alatdb' type='submit' id='update' name='update'>OK</button>
                            "; 
                            echo "</div>";
                    } else {
                        echo "<form method='POST' action='update.php' enctype='multipart/form-data'>
                        <label class='csvstyle' for='csv'></label>
                        <input type='file' id='csv' name='csv'>
                        <input type='submit' id='csvsub' name='csvsub' class='csvsub' value='Import'/>
                        </form>";
                        echo '<br/><br/><br/><br/><br/><br/><br/><br/><span style="margin: 38.5%; font-size:20px;">Tidak mempunyai data untuk dipapar</span>';
                    }
                } else if ($database == 'kerosakan'){
                    $rosakdb = "SELECT * FROM kerosakan"; //LIMIT $startFrom, $rowsDisplayed";
                    $rquery = mysqli_query($connection, $rosakdb);
                    $rgetrows = mysqli_num_rows($rquery);
                    if ($rgetrows > 0){
                        echo "<form method='POST' action='update.php' enctype='multipart/form-data'>
                            <label class='csvstyle' for='csv2'></label>
                            <input type='file' id='csv2' name='csv2'>
                            <input type='submit' id='csvsub2' name='csvsub2' class='csvsub' value='Import'/>
                            <input type='text' id='searchbox' name='searchbox' class='searchbox2' onkeyup='rsearch()' placeholder='Cari Nama...'>
                            <select id='pilih' nama='pilih'>
                            <option value='KodAlat'>asd</option>
                            <option value='NamaAlat'>Nama Alat</option>
                            <option value='BilAlat'>Bilangan Alat</option>
                            <option value='JenisAlat'>Jenis Alat</option>
                            <option value='Pendaftar'>Pendaftar</option>
                            </select>
                            </form>";                            
                        echo "<form method='POST' id='rosakdb' action='update.php'>
                            <table id='kerosakan' border='1' style='border-collapse: collapse;'>
                            <tr>
                            <th></th>
                            <th>Kod Rosak</th>
                            <th>Nama Alat</th>
                            <th>Bilangan Alat</th>
                            <th>Jenis Rosak</th>
                            <th>Tarikh Rosak</th>
                            <th>Murid Terlibat</th>
                            <th>Pendaftar</th>                     
                            </tr>";
                        while($rrow = mysqli_fetch_array($rquery)){
                            echo "<tr>";
                            //Icons made by <a href="https://www.flaticon.com/authors/pixelmeetup" title="Pixelmeetup">Pixelmeetup</a> from <a href="https://www.flaticon.com/" 			    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" 			    title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY
                            echo "<td><button type='submit' title='Delete' style='height: 35px; background-color: white; border: none; cursor: pointer;' name='deleter' value='".$rrow['KOD_ROSAK']."'><img src='images/clear.png' style='width: 18px; margin: 50px; margin-top: 0; margin-bottom: 0;'/></button></td>";
                            echo "<td><input type='text' name='kodrosak[]' value='KR".$rrow['KOD_ROSAK']."' readonly='true'></td>";
                            echo "<td><input type='text' name='namaalatr[]' value='".$rrow['NAMA_ALAT']."' readonly='true'></td>";
                            echo "<td><input type='number' name='bilalatr[]' value='".$rrow['BIL_ALAT']."' readonly='true'></td>";
                            echo "<td><input type='text' name='jenisr[]' value='".$rrow['JENIS_ROSAK']."' readonly='true'></td>";
                            echo "<td><input type='text' name='tarikhr[]' value='".$rrow['TARIKH_ROSAK']."' readonly='true'></td>";
                            echo "<td><input type='text' name='perosak[]' value='".$rrow['MURID_TERLIBAT']."' readonly='true'></td>";
                            echo "<td><input type='text' name='pendaftar2[]' value='".$rrow['PEREKOD']."' readonly='true'></td>";
                            echo "</tr>";
                        }
                            echo "</table>
                            </form>
                            <button form='rosakdb' type='submit' id='update2' name='update2'>OK</button>
                            ";
                            echo "</div>";
                    } else {
                        echo "<form method='POST' action='update.php' enctype='multipart/form-data'>
                            <label class='csvstyle' for='csv2'></label>
                            <input type='file' id='csv2' name='csv2'>
                            <input type='submit' id='csvsub2' name='csvsub2' class='csvsub' value='Import'/>
                            </form>";
                        echo '<br/><br/><br/><br/><br/><br/><br/><br/><span style="margin: 38.5%; font-size:20px;">Tidak mempunyai data untuk dipapar</span>';
                    }
                }
                mysqli_close($connection);
            }
        ?>
    </div>
    <!--Icons made by <a href="https://www.freepik.com/" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" 			    title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" 			    title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY 
    <button type='button' id="pgdn" class="pgdn"></button>
    <button type='button' id="pgup" class="pgup"></button>-->
</body>
</html>