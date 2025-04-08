<!DOCTYPE html>
<html lang="en">
<?php
include 'database.php';
//TEST
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!--MAINDIV ======================================= -->
    <div class="min-vh-100 d-flex flex-row">
         <!--LEFT COLUMN ======================================= -->
        <div class="col-4 debug">
            <a class="btn btn-primary" href="index.php  ">Logout</a>
            <?php
            session_start();
            if ($_SESSION["name"] == "admin") {
                echo '<a class = "btn btn-primary" href = "register.php">Register</a>';
            }
            ?>
        </div>
         <!--MID COLUMN ======================================= -->
        <div class="col-4 debug">
            <div class="d-flex flex-column debug1 min-vh-100">
                <!--MSG TOP ROW ======================================= -->
                <div class="debug col-12 d-flex justify-content-center" id="col1">MESSAGES</div>
                <!--MSG MID ROW ======================================= -->
                <div class="debug col-12" id="col2">test</div>
                <!--MSG BOTTOM ROW ======================================= -->
                <div class="debug col-12 d-flex flex-row" id="col3">
                    <div class="d-flex" id="message_box"> </div>
                    <div class="d-flex" id="message_button"> 
                        <a href = "" class = "btn btn-primary" id ="send_button">send</a>
                    </div>
                </div>
            </div>
        </div>
        <!--RIGHT COLUMN ======================================= -->
        <div class="col-4 debug justify-content-center">
            <table class="d-flex justify-content-center">
                <th> Name </th>
                <?php
                $query = "SELECT name FROM user";
                $result = $conn->query($query);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "
                            <tr>
                                <td>{$row['name']}
                            <tr>";
                    }
                } else {
                    echo "";
                }
                ?>
            </table>
        </div>
    </div>
    <script src="bootstrap/bootstrap.min.js"></script>
</body>

</html>
<?php
$conn->close()
    ?>