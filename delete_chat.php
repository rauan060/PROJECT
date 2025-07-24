<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $conn = getDBConnection();
    $stmt = $conn->prepare("DELETE FROM chat WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

header("Location: admin_chat.php");
exit();
