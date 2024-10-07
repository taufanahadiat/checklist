<?php

if (session_id() == '') {
  session_start();
}
if (empty($_SESSION['loggedin'])) {
    header("Refresh: 0; url=../");
    exit();
}

include "../include/db.php";
$query = "SELECT first_name,ID,typeUser FROM user WHERE email = '$_SESSION[sesi_user]'";				
$hasil = mysql_query($query,$consql);
$baris = mysql_fetch_row($hasil);
$_SESSION['name_user'] = $baris[0];
$_SESSION['id'] = $baris[1];
$_SESSION['type_user'] = $baris[2];

$currentTimestamp = time(); // Get the current server timestamp
?> 

<style>
  .sideinfo {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 16px;
    font-weight: 500;
    display: block;
    position: static;
    float: right;
  }

  .hidden {
    display: none;
}

  #browser-warning {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    padding: 20px;
    background-color: #f8d7da;
    color: #721c24;
    text-align: center;
    border: 1px solid #f5c6cb;
    z-index: 9999;
}

#browser-warning p {
    margin: 0;
}
</style>

<div class="header-img">
  <img id="logo" src="css/logo.png" alt="Logo Argha"><br>
  <img id="exit" src="css/exit.png" alt="Exit"><br>
</div>

<div id="browser-warning" class="hidden">
        <p>Your browser is not compatible with this page. Please use a modern browser like Google Chrome, Mozilla Firefox, or Microsoft Edge.</p>
</div>

<header>
  <h1>ONLINE CHECKLIST</h1>
  <div class="timeNow">
    <p id="currentDateTime" class="sideinfo" style="color: #314775; font-weight: 650"></p> <!-- This will display the current date and time -->
    <p class="sideinfo" style="color: #314775; font-weight: 650">
    &nbsp;<i class="fa-solid fa-user"></i>&nbsp;<?php echo "$baris[0]"; ?>&nbsp;|&nbsp;
</p>

  </div>
</header>

<script src="js/crypto-js.min.js"></script>
<script>
  // Function to update the time every second
  function updateDateTime() {
      // Increment the server timestamp by one second each time this function is called
      serverTimestamp += 1;

      // Create a new Date object using the incremented timestamp
      var now = new Date(serverTimestamp * 1000);

      // Format the date and time
      var options = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit' };
      var dateTimeString = new Intl.DateTimeFormat('en-GB', options).format(now);

      // Display the formatted date and time on the page
      document.getElementById('currentDateTime').textContent = dateTimeString.replace(",", "");
  }

  // Initialize with the server's timestamp
  var serverTimestamp = <?php echo $currentTimestamp; ?>;

  // Update date and time every second
  setInterval(updateDateTime, 1000);

  // Check the title of the document
  if (document.title === "Home") {
      document.getElementById("exit").src = "css/exit.png";
      document.getElementById("exit").alt = "Exit";
  } else {
      document.getElementById("exit").src = "css/back.png";
      document.getElementById("exit").alt = "Back";
  }

  function showPasswordModal() {
    // Check if the session ID is 13107
    if (<?php echo $_SESSION['id']; ?> === 13107 || <?php echo $_SESSION['id']; ?> === 14201) {
        var form = document.getElementById("verificationForm");
        var formData = new FormData(form);

        // Directly send the form data to verifikasi.php without showing the modal
        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            alert(result.message); // Show the alert message

            if (result.status === "success") {
                location.reload(); // Reload the current page if the verification is successful
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("An error occurred. Please try again.");
        });
    } else {
        // Show the password modal if session ID is not 13107
        document.getElementById("passwordModal").style.display = "block";
        var passwordInput = document.getElementById("passwordInput");
        passwordInput.focus(); // Automatically focus on the password input field

        document.getElementById("passwordInput").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault(); // Prevent the default form submission behavior
                verifyPassword(); // Trigger the verifyPassword function
            }
        });
    }
}


        function closePasswordModal() {
            document.getElementById("passwordModal").style.display = "none";
        }
        

    function verifyPassword() {
    var passwordInput = document.getElementById("passwordInput");
    var password = passwordInput.value;
    var hashedPassword = CryptoJS.MD5(password).toString(); // Hash the password
    var form = document.getElementById("verificationForm");
    var formData = new FormData(form);

    // Append hashed password to FormData
    formData.append('password', hashedPassword);

    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(result => {
        alert(result.message); // Show the alert message

        if (result.status === "success") {
            location.reload(); // Reload the current page if the verification is successful
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert("An error occurred. Please try again.");
    });

    closePasswordModal(); // Hide the modal after verification
}
    
function isIncompatibleBrowser() {
    const userAgent = navigator.userAgent;

    // Check for Internet Explorer Mobile
    const isOldIE = /IEMobile/.test(userAgent);

    // Check for obscure or outdated browsers
    const isObscureBrowser = /UCWEB|Opera Mini/.test(userAgent);

    // Check for Internet Explorer
    const isIE = /MSIE|Trident/.test(userAgent);
    // Check for other older browsers if needed
    // Example for older versions of Safari
    const isOldSafari = /Safari/.test(userAgent) && !/Chrome/.test(userAgent);


    return isIE || isOldSafari || isOldIE || isObscureBrowser;
}

document.addEventListener('DOMContentLoaded', function () {
    if (isIncompatibleBrowser()) {
        document.getElementById('browser-warning').classList.remove('hidden');
    }
});

function toggleLegend() {
        const legendTable = document.getElementById('legendTable');
        const legendBtn = document.getElementById('legendBtn');
        if (legendTable.style.display === 'none' || legendTable.style.display === '') {
            legendTable.style.display = 'block';
            legendBtn.textContent = 'Hide Legend';
        } else {
            legendTable.style.display = 'none';
            legendBtn.textContent = 'Show Legend';
        }
        }

</script>
