<?php
include "../db.php";
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['save'])){

    $key = $_POST['key'];
    $message = $_POST['message'];

    $encrypted = base64_encode($message);

    $imageName = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "../upload/".$imageName);

    $conn->query("INSERT INTO messages(image_name, encrypted_message, secret_key)
    VALUES('$imageName','$encrypted','$key')");

    echo "<script>alert('Message Added Successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>

<style>
body{
    margin:0;
    font-family:Arial;
    background:#0f172a;
    color:white;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

/* Logout Button */
.top-bar{
    position:fixed;
    top:20px;
    right:20px;
}

.logout-btn{
    background:#ef4444;
    color:white;
    padding:10px 15px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
}

/* BOX (MATCH LOGIN STYLE) */
.box{
    width:320px;
    background:rgba(255,255,255,0.08);
    padding:30px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 0 25px rgba(56,189,248,0.3);
    backdrop-filter: blur(5px);
}

h2{
    color:#38bdf8;
}

input,textarea{
    width:100%;
    padding:10px;
    margin:10px 0;
    border-radius:8px;
    border:none;
    outline:none;
}

textarea{
    resize:none;
    height:80px;
}

button{
    width:100%;
    padding:10px;
    background:#38bdf8;
    border:none;
    border-radius:8px;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:#0ea5e9;
}
</style>

</head>

<body>

<!-- LOGOUT -->
<div class="top-bar">
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<!-- FORM -->
<div class="box">

    <h2>Add Message</h2>

    <form method="post" enctype="multipart/form-data">

        <input name="key" placeholder="Secret Key" required>

        <textarea name="message" placeholder="Message" required></textarea>

        <input type="file" name="image" required>

        <button name="save">Save Message</button>

    </form>

</div>

</body>
</html>