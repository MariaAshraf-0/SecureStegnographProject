<?php
include "db.php";
include "function.php";
session_start();

if(isset($_POST['submit'])){

    $msg = $_POST['message'];
    $key = $_POST['key'];

    $encrypted = encryptData($msg, $key);

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "upload/".$image);

    $uid = $_SESSION['user'];

    $conn->query("INSERT INTO messages(user_id,image_name,encrypted_message,secret_key)
    VALUES('$uid','$image','$encrypted','$key')");

    echo "Message Hidden Successfully!";
}
?>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="message" placeholder="Secret Message"><br>
    <input type="text" name="key" placeholder="Encryption Key"><br>
    <input type="file" name="image"><br>
    <button name="submit">Hide Message</button>
</form>