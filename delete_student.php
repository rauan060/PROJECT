<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $student_id = intval($_GET['id']);

    $conn = getDBConnection();

    $sql = "DELETE FROM students WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);

    if ($stmt->execute()) {
        // Успешно удалено — вернуться в админку
        header("Location: admin_students.php");
        exit();
    } else {
        echo "❌ Error deleting student: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "⚠️ Invalid request. No student ID provided.";
}

