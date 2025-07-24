<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getDBConnection();
    
    $student_code = $conn->real_escape_string($_POST['student_code']);
    $password = $_POST['password'];
     
    $sql = "SELECT student_id, password FROM students WHERE student_code = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $student_code);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $student = $result->fetch_assoc();
        
        if (password_verify($password, $student['password'])) {
             
            $_SESSION['student_id'] = $student['student_id'];
            $_SESSION['student_code'] = $student_code;
            
            $_SESSION['last_activity'] = time();          // Засекаем момент входа
            $_SESSION['expire_time'] = 600;               // 600 секунд = 10 минут

             
            header("Location: index.php");
            exit();
        } else {
            die("Invalid password! <a href='login.html'>Try again</a>");
        }
    } else {
        die("Student not found! <a href='register.html'>Register here</a>");
    }
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: login.html");
    exit();
}
?>