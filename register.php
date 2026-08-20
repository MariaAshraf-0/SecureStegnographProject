<?php
include "db.php";

$msg = "";

if(isset($_POST['register'])){
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM users WHERE username='$username'");

    if($check->num_rows > 0){
        $msg = "⚠ Username already exists!";
    } else {
        $conn->query("INSERT INTO users(username,password) VALUES('$username','$password')");
        $msg = "✅ Registered successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<style>
body {
    margin:0;
    font-family:Arial;
    background: linear-gradient(135deg,#0f172a,#1e293b);
    color:white;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.card {
    background: rgba(255,255,255,0.08);
    padding:30px;
    border-radius:15px;
    width:300px;
    box-shadow:0 0 20px rgba(56,189,248,0.3);
    text-align:center;
}

input {
    width:100%;
    padding:10px;
    margin:10px 0;
    border:none;
    border-radius:8px;
}

button {
    width:100%;
    padding:10px;
    background:#38bdf8;
    border:none;
    border-radius:8px;
    font-weight:bold;
    cursor:pointer;
}

button:hover {
    background:white;
}

a {
    color:#38bdf8;
    text-decoration:none;
}

.msg {
    margin-top:10px;
    color:#22c55e;
}
</style>
</head>
<body>

<div class="card">
    <h2>📝 Register</h2>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="register">Register</button>
    </form>

    <p class="msg"><?php echo $msg; ?></p>

    <p>Already have account? <a href="login.php">Login</a></p>
</div>

</body>
</html>