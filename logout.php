<?php
session_start();

if (isset($_POST["logout"]) && $_POST["logout"] == 1) {
    if (isset($_SESSION["username"])) {
        $_SESSION = array();
        session_destroy();
    }
}

header("Location: index.php");
exit();
?>
