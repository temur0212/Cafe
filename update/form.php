<?php
include "../connect.php";
$id = mysqli_real_escape_string($connect, $_GET['id']); 

$sql = "SELECT * FROM odamlar WHERE id='$id'"; 
$result = mysqli_query($connect, $sql);

$id = '';
$ism = '';
$yoshi = '';
$jinsi = '';
$yili = '';

if ($result && mysqli_num_rows($result) > 0) {
    while ($a = mysqli_fetch_assoc($result)) {
        $id = $a['id'];
        $ism = $a['ism'];
        $yoshi = $a['yoshi'];
        $jins = $a['jins'];
        $yili = $a['yili'];
    }
}

?>

<form action="valid.php" method="POST">

    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"><br>

    <label for="ism">Ismi</label><br>
    <input type="text" name="ism" id="ism" value="<?php echo $ism; ?>"><br>

    <label for="yoshi">Yoshi</label><br>
    <input type="number" name="yoshi" id="yoshi" value="<?php echo $yoshi; ?>"><br>

    <label for="jins">Jinsi</label><br>
    <input type="text" name="jins" id="jins" value="<?php echo $jins; ?>"><br>

    <label for="yili">Yili</label><br>
    <input type="number" name="yili" id="yili" value="<?php echo $yili; ?>"><br>

    <input type="submit" name="submit">
</form>
