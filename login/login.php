<?php
session_start();
require_once "../connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM user WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user["password"])) {
      $_SESSION["loggedin"] = true;
      $_SESSION["user_id"] = $user["id"];
      $_SESSION["username"] = $user["username"];
      header("Location: welcome.php");
    } else {
      echo "Invalid password.";
    }
  } else {
    echo "Invalid username.";
  }
  $stmt->close();
  $conn->close();
}
?>
