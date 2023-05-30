<?php
include "connect.php";


// Function to sanitize user input
function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Sign up logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {
    $username = sanitizeInput($_POST["username"]);
    $password = sanitizeInput($_POST["password"]);

    // Perform input validation
    // ...

    // Check if the username is already taken
    $check_query = "SELECT * FROM users WHERE username = '$username'";
    $check_result = $conn->query($check_query);
    if ($check_result->num_rows > 0) {
        $signup_error = "Username already exists";
    } else {
        // Insert the new user into the database
        $signup_query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if ($conn->query($signup_query) === TRUE) {
            $signup_success = "Sign up successful. You can now log in.";
        } else {
            $signup_error = "Sign up failed. Please try again later.";
        }
    }
}

// Login logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $username = sanitizeInput($_POST["username"]);
    $password = sanitizeInput($_POST["password"]);

    // Perform input validation
    // ...

    // Check if the username and password match in the database
    $login_query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $login_result = $conn->query($login_query);
    if ($login_result->num_rows > 0) {
        // Successful login, redirect to a dashboard page or display a success message
        $login_success = "Login successful";
    } else {
        // Invalid login, display an error message
        $login_error = "Invalid username or password";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login and Sign Up</title>
</head>
<body>
    <h2>Sign Up</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <label for="signup-username">Username:</label>
            <input type="text" name="username" id="signup-username" required>
        </div>
        <div>
            <label for="signup-password">Password:</label>
            <input type="password" name="password" id="signup-password" required>
        </div>
        <div>
            <input type="submit" name="signup" value="Sign Up">
        </div>
        <p><?php echo isset($signup_error) ? $signup_error : ""; ?></p>
        <p><?php echo isset($signup_success) ? $signup_success : ""; ?></p>
    </form>

    <h2>Login</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div>
            <label for="login-username">Username:</label>
            <input type="text" name="username" id="login-username" required>
        </div>
        <div>
            <label for="login-password">Password:</label>
            <input type="password" name="password" id="login-password" required>
        </div>
        <div>
            <input type="submit" name="login" value="Login">
        </div>
        <p><?php echo isset($login_error) ? $login_error : ""; ?></p>
        <p><?php echo isset($login_success) ? $login_success : ""; ?></p>
    </form>
</body>
</html>



