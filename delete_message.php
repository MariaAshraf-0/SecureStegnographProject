<?php
include "../db.php";
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$conn->query("DELETE FROM messages WHERE id=$id");

header("Location: view_messages.php");
?>