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
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <header>
    <img id="logo" src="css/logo.png" alt="Logo Argha"><br>
    <img id="exit" src="css/exit.png" alt="Exit"><br>
    <h1 style="text-align: center";>ONLINE CHECKLIST</h1>
  </header>
  
  <form>
  <div class="radio">
    <label id="menu-form">
      <img class="img" src="css/centang.png" alt="Form Checklist">
      <div class="selection-indicator">Form Checklist</div>
      <input type="radio" id="form-btn" name="mode" value="form">
    </label>
    <label id="menu-view">
      <img class="img" src="css/review.png" alt="View Checklist">
      <div class="selection-indicator">View Data</div>
      <input type="radio" id="view-btn" name="mode" value="view">
    </label>
      </div>
  </form>

  <div id="select-form" style="display: none;">
  <form name="select-form" action="form-genset-wartsila.php">
    
    <div class="custom-label"> 
      <div class="unitfield">
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
      <br><br>
    </div>


    <input class="btn" type="submit" value="SUBMIT">
  </form>
  </div>
  
  <div id="select-view" style="display: none;">
  <form name="select-view" action="article.php">
    
    <div class="custom-label"> 
      <div class="unitfield">
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
      </div>

      <div class="tanggalfield">
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


      </div>
      <br><br>
    </div>


    <input class="btn" type="submit" value="SUBMIT">
  </form>
  </div>

  <script>
      document.getElementById("exit").onclick=function (){
      location.href = 'selection.php'
        }


        $(document).ready(function() {
        $('input[name="mode"]').click(function() {
        if($(this).attr('id') == 'form-btn') {
            $('#select-form').show(); 
            $('#select-view').hide();          
        }

       else if($(this).attr('id') == 'view-btn'){
            $('#select-view').show(); 
            $('#select-form').show();  
       }
        else {
            $('#select-form').hide(); 
            $('#select-view').hide();  
            }
                });
      });

    $(".selection").prop("selectedIndex", -1);

  </script>
  </body>
</html>