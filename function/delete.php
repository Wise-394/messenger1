<?php
include '../database.php';

session_start();
if (isset($_GET['name'])) {
    $name = $_GET['name'];

    if ($_SESSION["name"] === "admin" || $_SESSION["name"] === $name) {
        $query = "DELETE FROM user WHERE name = '$name'";
        if ($conn->query($query)) {
            if ($_SESSION['name'] == 'admin') {
                header("Location: ../home.php");
                exit();
            } else {
                header("Location: ../index.php");
                session_unset();
                session_destroy();
                exit();
            }
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "Unauthorized access.";
    }
} else {
    echo "No user selected for deletion.";
}

$conn->close();
?>