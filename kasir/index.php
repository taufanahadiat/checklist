<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "akpidev3";
$dbname = "kasir";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables for user input
$user = $pass = "";
$login_err = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from POST data
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT * FROM user WHERE id = ? AND pass = ?");
    $stmt->bind_param("ss", $user, $pass);

    // Execute query
    $stmt->execute();

    // Store result
    $stmt->store_result();

    // Check if username and password match
    if ($stmt->num_rows > 0) {
        // Start a session
        session_start();

        // Store data in session variables
        $_SESSION["username"] = $user;

        // Redirect to dashboard upon successful login
        header("location: dashboard.php");
        exit();
    } else {
        $login_err = "Invalid username or password.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="login-header">
                <h1>Welcome Back!</h1>
                <p>Please sign in to continue.</p>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <button type="submit">Sign In</button>
                </div>
                <div class="form-group">
                    <span class="error"><?php echo $login_err; ?></span>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
