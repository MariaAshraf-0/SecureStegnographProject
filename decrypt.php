<?php
include "db.php";
include "function.php";

if(isset($_POST['decrypt'])){

    $id = $_POST['id'];
    $key = $_POST['key'];

    $res = $conn->query("SELECT * FROM messages WHERE id='$id'");
    $row = $res->fetch_assoc();

    $data = decryptData($row['encrypted_message'], $key);

    echo "<h3>Decrypted Message: $data</h3>";
}
?>

<form method="post">
    <input type="text" name="id" placeholder="Message ID"><br>
    <input type="text" name="key" placeholder="Key"><br>
    <button name="decrypt">Decrypt</button>
</form>