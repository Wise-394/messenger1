<!DOCTYPE html>
<html lang="en">
<?php
include "database.php";
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="min-vh-100 justify-content-center d-flex align-items-center">
        <div class="debug p-3">
            <form class="d-flex flex-column" action="" method="POST">
                <a class="btn btn-primary" href="home.php">go back</a>
                <label> Username </label>
                <input type="text" name="name" placeholder="Enter username">

                <label> Password </label>
                <input type="password" name="password" placeholder="Enter password">

                <input type="submit" name="register" value="Register" class="mt-3 btn btn-primary">
            </form>
        </div>
    </div>
    <script src="bootstrap/bootstrap.min.js"></script>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['register']) && !empty($_POST['name']) && !empty($_POST['password'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $check = "SELECT * from user WHERE name = '$name'";
        $check_result = $conn->query($check);
        if ($check_result->num_rows <= 0) {
            $query = "INSERT INTO user(name,password) VALUES('$name','$password')";
            if ($conn->query($query) == TRUE) {
                echo "success";
            }
        } else {
            echo "duplicate";
        }
    }
}
$conn->close();
?>