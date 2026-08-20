<?php
include "../db.php";
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$res = $conn->query("SELECT * FROM messages");
?>

<!DOCTYPE html>
<html>
<head>
<title>All Messages</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background:#0f172a;
    color:white;
}

/* TOP BAR */
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

.logout-btn:hover{
    background:#dc2626;
}

/* PAGE WRAPPER */
.container{
    display:flex;
    justify-content:center;
    align-items:flex-start;
    padding-top:80px;
}

/* BOX */
.box{
    width:90%;
    background:#1e293b;
    padding:20px;
    border-radius:12px;
    box-shadow:0 0 20px rgba(0,0,0,0.4);
}

/* TABLE */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
    overflow:hidden;
    border-radius:10px;
}

th,td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #334155;
}

th{
    background:#0f172a;
    color:#38bdf8;
}

img{
    width:60px;
    border-radius:6px;
}

a{
    color:#38bdf8;
    text-decoration:none;
    font-weight:bold;
}

a:hover{
    color:#0ea5e9;
}
</style>

</head>

<body>

<!-- LOGOUT -->
<div class="top-bar">
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<!-- TABLE -->
<div class="container">

<div class="box">

    <h2>All Messages</h2>

    <table>

        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Key</th>
            <th>Action</th>
        </tr>

        <?php while($row = $res->fetch_assoc()){ ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td>
                <img src="../upload/<?php echo $row['image_name']; ?>">
            </td>
            <td><?php echo $row['secret_key']; ?></td>
            <td>
                <a href="delete_message.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>

        <?php } ?>

    </table>

</div>

</div>

</body>
</html>