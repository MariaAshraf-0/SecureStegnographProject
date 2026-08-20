<?php
include "db.php";
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$uid = $_SESSION['user'];

$res = $conn->query("SELECT * FROM messages WHERE user_id='$uid'");
?>

<!DOCTYPE html>
<html>
<head>
<title>My Messages</title>

<style>
body{
    font-family:Arial;
    background:#0f172a;
    color:white;
    text-align:center;
}

table{
    width:85%;
    margin:auto;
    border-collapse:collapse;
    margin-top:40px;
}

th,td{
    border:1px solid #38bdf8;
    padding:10px;
}

th{
    background:#38bdf8;
    color:black;
}
</style>
</head>

<body>

<h2>📁 My Stored Messages</h2>

<table>
<tr>
    <th>ID</th>
    <th>Image</th>
    <th>Encrypted</th>
    <th>Key</th>
</tr>

<?php while($row=$res->fetch_assoc()){ ?>
<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['image_name']; ?></td>
    <td><?php echo substr($row['encrypted_message'],0,25); ?>...</td>
    <td><?php echo $row['secret_key']; ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>