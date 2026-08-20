<?php
include "db.php";
include "function.php";
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$msg = "";

if(isset($_POST['submit'])){

    $message = $_POST['message'];
    $key = $_POST['key'];

    // Encrypt message
    $encrypted = encryptData($message, $key);

    // Image upload
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "upload/".$image);

    $uid = $_SESSION['user'];

    $conn->query("INSERT INTO messages(user_id,image_name,encrypted_message,secret_key)
    VALUES('$uid','$image','$encrypted','$key')");

    $msg = "✅ Message Hidden Successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Hide Message</title>

<style>
body{
    font-family:Arial;
    background:#0f172a;
    color:white;
    text-align:center;
}

.box{
    width:350px;
    margin:80px auto;
    padding:30px;
    background:rgba(255,255,255,0.08);
    border-radius:15px;
}

input,button{
    width:100%;
    padding:10px;
    margin:10px 0;
}

button{
    background:#38bdf8;
    border:none;
    font-weight:bold;
}
</style>
</head>

<body>

<div class="box">
    <h2>🔐 Hide Message</h2>

    <form method="post" enctype="multipart/form-data">
        <input type="text" name="message" placeholder="Enter Secret Message" required>
        <input type="text" name="key" placeholder="Encryption Key" required>
        <input type="file" name="image" required>
        <button name="submit">Hide</button>
    </form>

    <p><?php echo $msg; ?></p>
</div>

</body>
</html>