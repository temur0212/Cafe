<?php
include "../connect.php";
// Define username and password
$valid_username = "admin";
$valid_password = "password123";

// Initialize variables
$username = "";
$password = "";
$login_error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the credentials
    if ($username == $valid_username && $password == $valid_password) {
        // Successful login, redirect to a dashboard page or display a success message
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid login, display an error message
        $login_error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?php echo $username; ?>">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
    </form>
    <p><?php echo $login_error; ?></p>
</body>
</html>
