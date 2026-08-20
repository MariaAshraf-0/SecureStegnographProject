<?php
include "db.php";
include "function.php";

$result = "";

if(isset($_POST['decrypt'])){

    $id = $_POST['id'];
    $key = $_POST['key'];

    $res = $conn->query("SELECT * FROM messages WHERE id='$id'");
    $row = $res->fetch_assoc();

    if($row){
        $result = decryptData($row['encrypted_message'], $key);
    } else {
        $result = "❌ Invalid ID";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Extract Message</title>

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
}
</style>
</head>

<body>

<div class="box">
    <h2>🔓 Extract Message</h2>

    <form method="post">
        <input type="text" name="id" placeholder="Message ID" required>
        <input type="text" name="key" placeholder="Secret Key" required>
        <button name="decrypt">Extract</button>
    </form>

    <h3><?php echo $result; ?></h3>
</div>

</body>
</html>