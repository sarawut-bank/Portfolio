<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["usernameLog"];
    $password = $_POST["passwordLog"];

    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "miniprojectct319";

    $conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT * FROM user WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $username;
            header("Location: homepage.php"); 
            exit();
        } else {
            $error = "รหัสผ่านไม่ถูกต้อง";
        }
    } else {
        $error = "ไม่พบชื่อผู้ใช้";
    }

    mysqli_close($conn);
}

if (isset($error)) {
    echo $error;
}
?>
