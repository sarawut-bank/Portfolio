<?php

    session_start();

    $host = "localhost"; 
    $username = "root"; 
    $password = "";
    $database = "miniprojectct319"; 

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["usernameRegis"];
        $name = $_POST["nameRegis"];
        $surname = $_POST["surnameRegis"];
        $email = $_POST["emailRegis"];
        $password = password_hash($_POST["passwordRegis"], PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (username, name, surname, email, password) VALUES ('$username', '$name', '$surname', '$email', '$password')";

        if (mysqli_query($conn, $sql)) {
            
            $_SESSION["username"] = $username;

            header('Location: homepage.php');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>

