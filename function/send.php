<?php
include "../database.php";
session_start();
$name =  $_SESSION['name'];
$message = $_POST['message'];
$datetime =  date("Y-m-d H:i:s");
$query = "INSERT INTO messages(name,message,date) VALUES('$name','$message','$datetime')";

$conn->query($query);
header("Location: ../home.php");

?>