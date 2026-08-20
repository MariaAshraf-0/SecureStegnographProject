<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background:#0f172a;
    color:white;
}

/* SIDEBAR */
.sidebar{
    position:fixed;
    width:220px;
    height:100%;
    background:#1e293b;
    padding-top:20px;
}

.sidebar h2{
    text-align:center;
    margin-bottom:30px;
    color:#38bdf8;
}

.sidebar a{
    display:block;
    color:white;
    padding:12px 20px;
    text-decoration:none;
    transition:0.3s;
}

.sidebar a:hover{
    background:#334155;
}

/* MAIN AREA */
.main{
    margin-left:220px;
    padding:40px;
}

/* HEADER CARD */
.header-card{
    background:#1e293b;
    padding:30px;
    border-radius:15px;
    box-shadow:0 0 25px rgba(56,189,248,0.15);
}

/* TITLE STYLE */
.header-card h1{
    margin:0;
    color:#38bdf8;
    font-size:26px;
}

.header-card p{
    margin-top:10px;
    color:#cbd5e1;
}

/* TOP LOGOUT */
.top-bar{
    position:fixed;
    top:20px;
    right:20px;
    z-index:1000;
}

.logout-btn{
    background:#ef4444;
    color:white;
    padding:10px 16px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
    transition:0.3s;
}

.logout-btn:hover{
    background:#dc2626;
}
</style>

</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <h2>Admin Panel</h2>

    <a href="dashboard.php">Dashboard</a>
    <a href="add_message.php">Add Message</a>
    <a href="view_messages.php">View Messages</a>

</div>

<!-- LOGOUT -->
<div class="top-bar">
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<!-- MAIN CONTENT -->
<div class="main">

    <div class="header-card">
        <h1>Welcome, Admin</h1>
        <p>You can manage messages, users, and system data from this dashboard.</p>
    </div>

</div>

</body>
</html>