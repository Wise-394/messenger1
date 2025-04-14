<!DOCTYPE html>
<html lang="en">
<?php
include 'database.php';
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- MAINDIV ======================================= -->
    <div class="min-vh-100 d-flex flex-row">

        <!-- LEFT COLUMN ======================================= -->
        <div class="col-4 p-4 border-end d-none d-lg-block">
        </div>

        <!-- MIDDLE COLUMN ======================================= -->
        <div class="col-12 col-md-6 col-lg-4 p-3 d-flex flex-column min-vh-100 border-end">
            <div class="d-flex flex-column min-vh-100">
                <!-- MSG TOP ROW ======================================= -->
                <div class="d-flex justify-content-between">
                    <a class="btn btn-danger mb-3" href="./function/logout.php">Logout</a>
                    <div class="text-center mb-3" id="col1">
                        <h5>Messages</h5>
                        <p class="text-muted mb-0">Currently logged in: <?php echo $_SESSION['name'] ?></p>
                    </div>
                    <?php
                    if ($_SESSION["name"] === "admin") {
                        echo '<a class="btn btn-success mb-3" href="register.php">Register</a>';
                    }
                    ?>
                </div>
                <div class="col-12 flex-grow-1 border rounded p-2 mb-3 overflow-auto" id="col2">
                    <?php
                    $query = "SELECT name,message,date FROM messages ORDER BY date ASC";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="message mb-2">';
                            echo '<strong>' . htmlspecialchars($row['name']) . ':</strong> ';
                            echo htmlspecialchars($row['message']);
                            echo '</div>';
                        }
                    } else {
                        echo "No messages found.";
                    }
                    ?>
                </div>

                <!-- MSG BOTTOM ROW ======================================= -->
                <div class="col-12" id="col3">
                    <form class="d-flex flex-row" method="POST" action="./function/send.php">
                        <input type="text" class="form-control me-2" id="message_box" placeholder="Type a message..."
                            aria-label="Message input" name="message">
                        <input type="submit" name="send" class="btn btn-primary" id="send_button">
                    </form>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN mobile toggle ======================================= -->
        <button class="btn btn-primary hamburger-btn d-lg-none" id="toggleUsers">
            Users
        </button>
        <div class="col-4 p-4 users-column d-none d-lg-block" id="usersColumn">
            <h5 class="text-center mb-3">Users</h5>
            <table class="table table-bordered table-striped">
                <tbody>
                    <?php
                    $query = "SELECT name FROM user";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . $row['name'] . "</td>";
                            if ($_SESSION["name"] === "admin" && $_SESSION["name"] !== $row['name'] || $_SESSION["name"] === $row['name']) {
                                if ($_SESSION["name"] !== "admin" || $_SESSION["name"] !== $row['name']) {
                                    echo "<td><a class='btn btn-danger btn-sm' href='./function/delete.php?name=" . urlencode($row['name']) . "'>Delete</a></td>";
                                }
                            } else {
                                echo "<td></td>";
                            }
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="bootstrap/bootstrap.min.js"></script>
    <script>
        document.getElementById('toggleUsers').addEventListener('click', function() {
            document.getElementById('usersColumn').classList.toggle('show');
            document.getElementById('usersColumn').classList.toggle('d-none');
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>