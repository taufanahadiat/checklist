<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli('localhost', 'root','','checklistnew_24');

$result_tanggal = $mysqli->query("SELECT tanggal FROM genset_wartsila_01");

?>

<!DOCTYPE html>
<html>
  <head>
  <title>Home</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <header>
    <h1 style="text-align: center";>STANDBY CHECKLIST</h1>
  </header>
<div class="custom-label">  
<form action="/article.php">
<label for="unit">Pilih Unit:</label>
  <select class="selection" name="unit">
    <?php

      $dbname = 'checklistnew_24';

      $sql = "SHOW TABLES FROM $dbname";
      $result_unit = $mysqli->query($sql);


      $i=0;
      while ($row_unit = mysqli_fetch_row($result_unit)) 
      {
        $row_name= [
          0 => "Genset Wartsila 1",
          1 => "Genset Wartsila 2",
        ];
        
        if ($row_name[$i]==NULL)
        {
          $row_name[$i]="$row_unit[0]";
        }   
        echo "<option value='{$row_unit[0]}'>{$row_name[$i]}</option>";
        $i++;
      }

    ?>
    </select>

  <label for="tanggal">Pilih Tanggal:</label>
  <input type="date" class="input-container" name="tanggal">
  <!--<select name="tanggal">
   <?php 
      /*while($row_tanggal = $result_tanggal->fetch_assoc()) 
      {
        $tanggal = $row_tanggal["tanggal"];
        echo "<option value='$tanggal'>$tanggal</option>";
      }*/
   ?>
  </select>-->
  <br><br>
  <input class="btn" type="submit" value="SUBMIT">
</form>
</div>
</body>
</html>