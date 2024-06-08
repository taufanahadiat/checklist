<style>
      #currentDateTime {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 16px;
        font-weight: 500 ;
        display:block;
        position:static;
        float: right;
            
    }

</style>
<div class="header-img">
      <img id="logo" src="css/logo.png" alt="Logo Argha"><br>
      <img id="exit" src="css/exit.png" alt="Exit"><br>
      </div>
    <header>
      <h1>ONLINE CHECKLIST</h1>
      <div class="timeNow">
    <p id="currentDateTime"></p> <!-- This will display the current date and time -->
    </div>

    </header>
<script>
          function updateDateTime() {
        var now = new Date();
        var dateTimeString = now.toLocaleString();
        document.getElementById('currentDateTime').textContent = dateTimeString;
      }
      
      // Update date and time every second
      setInterval(updateDateTime, 1000);

</script>