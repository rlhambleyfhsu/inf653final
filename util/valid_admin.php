<?php
    session_status() === PHP_SESSION_ACTIVE ? '' : session_start();
    isset($_SESSION['is_valid_admin']) ? "" : header("Location: ./admin.php");
?>
