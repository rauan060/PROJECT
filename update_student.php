<?php
require_once 'config.php';

$conn = getDBConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id      = intval($_POST['student_id']);
    $full_name       = $_POST['full_name'];
    $student_code    = $_POST['student_code'];
    $email           = $_POST['email'];
    $programme_code  = $_POST['programme_code'];
    $faculty_code    = $_POST['faculty_code'];
    $semester        = $_POST['semester'];
    $campus          = $_POST['campus'];
    $gender          = $_POST['gender'];

    $sql = "UPDATE students 
            SET full_name = ?, 
                student_code = ?, 
                email = ?, 
                programme_code = ?, 
                faculty_code = ?, 
                semester = ?, 
                campus = ?, 
                gender = ? 
            WHERE student_id = ?";
    
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("❌ SQL Error: " . $conn->error);
    }

    $stmt->bind_param(
        "ssssssssi",
        $full_name,
        $student_code,
        $email,
        $programme_code,
        $faculty_code,
        $semester,
        $campus,
        $gender,
        $student_id
    );

    if ($stmt->execute()) {
        header("Location: admin_students.php?update=success");
        exit();
    } else {
        echo "❌ Error updating: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "⚠️ Invalid request method.";
}
