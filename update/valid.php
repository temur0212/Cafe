<?php
include "../connect.php";
$id = mysqli_real_escape_string($connect, $_POST['id']);
$ism = mysqli_real_escape_string($connect, $_POST['ism']);
$yoshi = mysqli_real_escape_string($connect, $_POST['yoshi']);
$jinsi = mysqli_real_escape_string($connect, $_POST['jins']);
$yili = mysqli_real_escape_string($connect, $_POST['yili']);

$sql = "UPDATE odamlar SET  ism='$ism', yoshi='$yoshi', jins='$jinsi', yili='$yili' WHERE id='$id'";
$result = mysqli_query($connect, $sql);

if ($result) {
    header("Location: ../index.php");
}
?>
