<?php
session_start();

$max_attempts = 3;
$lock_time = 60;

if(!isset($_SESSION['attempts'])){
    $_SESSION['attempts'] = 0;
}

if(!isset($_SESSION['lock_time'])){
    $_SESSION['lock_time'] = 0;
}

$remaining = 0;

// CHECK LOCK
if($_SESSION['attempts'] >= $max_attempts){
    $elapsed = time() - $_SESSION['lock_time'];

    if($elapsed < $lock_time){
        $remaining = $lock_time - $elapsed;
    } else {
        $_SESSION['attempts'] = 0;
    }
}

// LOGIN
if(isset($_POST['login']) && $remaining == 0){

    $user = $_POST['username'];
    $pass = $_POST['password'];

    if($user == "admin" && $pass == "admin123"){

        $_SESSION['admin'] = $user;
        $_SESSION['attempts'] = 0;

        header("Location: dashboard.php");
        exit();

    } else {

        $_SESSION['attempts']++;
        $_SESSION['lock_time'] = time();

        $error = "Invalid login! Attempt ".$_SESSION['attempts']." of 3";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

<style>
body{
    margin:0;
    font-family:Arial;
    background:#0f172a;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    color:white;
}

.box{
    width:320px;
    background:#1e293b;
    padding:30px;
    border-radius:12px;
    text-align:center;
}

/* SHAKE */
@keyframes shake {
    0% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    50% { transform: translateX(5px); }
    75% { transform: translateX(-5px); }
    100% { transform: translateX(0); }
}

.shake{
    animation:shake 0.4s;
}

/* INPUT */
input{
    width:100%;
    padding:10px;
    margin:10px 0;
    border:none;
    border-radius:8px;
    background:#0f172a;
    color:white;
}

/* ERROR INPUT */
.input-error{
    border:2px solid red;
    box-shadow:0 0 6px red;
}

/* BUTTON */
button{
    width:100%;
    padding:10px;
    background:#38bdf8;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

button:disabled{
    background:gray;
}

.error{
    color:red;
}

.lock{
    color:orange;
    margin-top:10px;
}
</style>

</head>

<body>

<div class="box" id="loginBox">

<h2>Admin Login</h2>

<form method="post">
    <input id="username" name="username" placeholder="Username" required>
    <input id="password" name="password" type="password" placeholder="Password" required>
    <button id="loginBtn" name="login" <?php if($remaining>0) echo "disabled"; ?>>
        Login
    </button>
</form>

<?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

<?php if($remaining>0){ ?>
<div class="lock">
    Locked: <span id="timer"><?php echo $remaining; ?></span>s
</div>
<?php } ?>

</div>

<script>

// SHAKE + INPUT ERROR (ONLY IF ERROR EXISTS)
<?php if(isset($error)){ ?>
    let box = document.getElementById("loginBox");
    let user = document.getElementById("username");
    let pass = document.getElementById("password");

    box.classList.add("shake");
    user.classList.add("input-error");
    pass.classList.add("input-error");

    setTimeout(()=>{
        box.classList.remove("shake");
        user.classList.remove("input-error");
        pass.classList.remove("input-error");
    },500);
<?php } ?>

// COUNTDOWN
let time = <?php echo $remaining; ?>;

if(time > 0){
    let timer = document.getElementById("timer");

    let interval = setInterval(()=>{
        time--;
        timer.innerText = time;

        if(time <= 0){
            clearInterval(interval);
            location.reload();
        }
    },1000);
}

</script>

</body>
</html>