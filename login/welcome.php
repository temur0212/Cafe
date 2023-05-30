<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("Location: index.html");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <>Welcome</title>
</head>
<body>
  <h1>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
  <p>< href="logout.php">Logout</a></p>
</body>
</html>
