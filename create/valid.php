<?php
include "../connect.php";

if (isset($_POST['submit'])) {
    // Validate form fields
    // ...

    if (isset($_FILES['rasm'])) {
        $errors = array();
        $file_name = $_FILES['rasm']['name'];
        $file_size = $_FILES['rasm']['size'];
        $file_tmp = $_FILES['rasm']['tmp_name'];
        $file_type = $_FILES['rasm']['type'];

        $file_exp = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_formats = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG");
        if (in_array($file_exp, $allowed_formats)) {
            $errors[] = "Rasm formati JPG yoki PNG bo'lishi kerak";
        }
        if ($file_size > 2097152) {
            $errors[] = "Rasm formati 2MB dan oshmasligi kerak";
        }
        if (empty($errors)) {
            $ism = $_POST['ism'];
            $yoshi = $_POST['yoshi'];
            $jins = $_POST['jins'];
            $yili = $_POST['yili'];

            $ism = mysqli_real_escape_string($connect, $ism);
            $yoshi = mysqli_real_escape_string($connect, $yoshi);
            $jins = mysqli_real_escape_string($connect, $jins);
            $yili = mysqli_real_escape_string($connect, $yili);
            $file_name = mysqli_real_escape_string($connect, $file_name);
            move_uploaded_file($file_tmp, '/images'.$file_name);
            if(move_uploaded_file($file_tmp, $file_path)) {
                $sql = "INSERT INTO odamlar (ism, yoshi, jins, yili, rasm) VALUES ('$ism', '$yoshi', '$jins', '$yili', '$file_name')";
                $result = mysqli_query($connect, $sql);

                if ($result) {
                    header("Location: ../index.php");
                    echo "Data inserted successfully.";
                } else {
                    echo "Error inserting data: " . mysqli_error($connect);
                }
            } else {
                echo "Error moving uploaded file.";
            }
        } else {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        }
    }
}
?>

