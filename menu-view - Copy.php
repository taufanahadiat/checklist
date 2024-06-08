  <form name="menu-view" action="article.php">
    
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

      <div class="tanggalfield" style='display: none'>
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
