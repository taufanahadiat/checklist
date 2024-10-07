<?php

session_start();

require_once '../config/config.php';

// Check if the user clicked "guest mode"
if (isset($_GET['guest']) && $_GET['guest'] === 'true') {
  $_SESSION["loggedin"] = TRUE;
  $_SESSION["name_user"] = "Guest";
  header("Location: ./selection.php");
  exit();
}

// cek session
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
  header("Location: ./selection.php");
  exit();
}


/**
 * Function to get the user's IP address
 */
function getUserIP() {
  // Check for shared internet/ISP IP
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  // Check for IPs passing through proxies
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      // This can contain multiple IPs, the first one is the client's IP
      $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
      $ip = trim($ipList[0]);
  }
  // Default fallback
  else {
      $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/x-icon" href="../../img/icon.ico">
  <title>Checklist Online</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" type="text/css" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" type="text/css" href="assets/css/AdminLTE.min.css">
  <link rel="stylesheet" href="fontawesome/css/all.css">
  <style type="text/css">
    body {
            background: #fff;
        }
        .bg::before {
            content: '';
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            position: absolute;
            z-index: -1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            opacity: 0.15;
            filter:alpha(opacity=15);
            height:100%;
            width:100%;
            background-color: #c1d6f3;
        }
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" type="text/css" href="assets/css/fontsgoogleapis.css">
</head>
<body class="hold-transition login-page shadow-3 bg">
  <div class="login-box">
      <div class="login-box-body">
    <div class="login-logo">
      <img width="160px" title="Arghapedia" src="../../img/Arghapedia.png" style="margin: 5px auto;vertical-align:middle;" />
      <div style="margin:10px;font-size:18px;">
        <strong>LOGIN CHECKLIST</strong>
      </div>
    </div>
    <!-- /.login-logo -->

    <div class="login-box-msg">Utility</div>

    <?php

// Handle guest mode
if (isset($_GET['mode']) && $_GET['mode'] === 'guest') {
  $guestEmail = 'guest';  // Assuming the email or username for guest is 'guest'
  
  $stmt = $db->prepare("SELECT * FROM user WHERE email = ?");
  $stmt->bind_param("s", $guestEmail);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
      $data = $result->fetch_assoc();
      $_SESSION["loggedin"] = TRUE;
      $_SESSION["idx"] = $data["ID"];
      $_SESSION["sesi_user"] = $data["email"];
      $_SESSION["name_user"] = $data["first_name"];
      $_SESSION['dept'] = $data['departemen'];
      $_SESSION["type_user"] = $data["typeUser"];
      
      // Update kunjungan count for the guest user
      $stmt = $db->prepare("UPDATE user SET kunjungan = kunjungan + 1 WHERE email = ?");
      $stmt->bind_param("s", $guestEmail);
      $stmt->execute();

      // Redirect to home page
      header("Location: ./selection.php");
      exit();
  } else {
      $_SESSION['errLog'] = 'Guest account not found.';
      header("Refresh: 0; url=./");
      die();
  }
}

// Handle regular login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

      $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
      

      $stmt = $db->prepare("SELECT * FROM user WHERE email = ?");
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();

      // jika user terdaftar
      if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        // Verify the password
        if (md5($password) === $data["pass"]) {
            $_SESSION["loggedin"] = TRUE;
            $_SESSION["idx"] = $data["ID"];
            $_SESSION["sesi_user"] = $data["email"];
            $_SESSION["name_user"] = $data["first_name"];
            $_SESSION['dept'] = $data['departemen'];
            $_SESSION["type_user"] = $data["typeUser"];
            $_SESSION["password"] = $data["pass"];
          
            // Detect user's IP
            $user_ip = getUserIP();
            // Update kunjungan count and store last login IP
            $stmt = $db->prepare("UPDATE user SET kunjungan = kunjungan + 1, last_login_ip = ? WHERE email = ?");
            $stmt->bind_param("ss", $user_ip, $username);
            $stmt->execute();


            // Redirect to home page
            header("Location: ./selection.php");
            exit();
        }  else {
            //session error
            $_SESSION['errLog'] = 'Username dan Password yang Anda masukkan salah, silahkan coba lagi.';
            header("Refresh: 0; url=./");
            die();
        } 
      } else {
          //session error
          $_SESSION['errLog'] = 'Username dan Password yang Anda masukkan salah, silahkan coba lagi.';
          header("Refresh: 0; url=./");
          die();
      }
    }

    ?>

    <form action="" method="post">
      <?php
        if (isset($_SESSION['errLog'])) {
          $errLog = $_SESSION['errLog'];
        ?>
          <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?=$errLog;?>
          </div>
      <?php
          unset($_SESSION['errLog']);
      }
      ?>
      <div class="form-group has-feedback">
        <input type="username" class="form-control" name="username" placeholder="Username/NIK" autofocus="autofocus">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <p style="margin-top:10px"><i class="fa-solid fa-arrow-left"></i>&nbsp;<a href="../index.php">to Arghapedia</a></p>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Log In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <center>
      <br>
        <p>Masuk sebagai&nbsp;<a href="./index.php?mode=guest">Guest Mode</a><br></p>
        <p>Developed by Electrical Department</p>
    </center>
    <br />

  </div>
  <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
  </html>
