<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = getDBConnection();
    
    
    $username = $conn->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $conn->real_escape_string($_POST['email']);
    $full_name = $conn->real_escape_string($_POST['name']);
    $ic_passport = $conn->real_escape_string($_POST['ic_passport']);
    $student_code = $conn->real_escape_string($_POST['student_id']);
    $faculty_code = $conn->real_escape_string($_POST['faculty_code']);
    $programme_code = $conn->real_escape_string($_POST['programme_code']);
    $campus = $conn->real_escape_string($_POST['campus']);
    $semester = $conn->real_escape_string($_POST['semester']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $level = $conn->real_escape_string($_POST['level']);
    $mode = $conn->real_escape_string($_POST['mode']);
    $nationality = $conn->real_escape_string($_POST['nationality']);
    $origin_country = $conn->real_escape_string($_POST['origin_country']);
    $address = $conn->real_escape_string($_POST['address']);
    $postcode = $conn->real_escape_string($_POST['postcode']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $scholarship = $conn->real_escape_string($_POST['scholarship']);
    
     
    $photo_path = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/students/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        $file_ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photo_name = $student_code . '_' . time() . '.' . $file_ext;
        $photo_path = $upload_dir . $photo_name;
        
        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path)) {
            die("Error uploading photo!");
        }
    }
    
    
    $check_sql = "SELECT student_id FROM students WHERE username = ? OR student_code = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("ss", $username, $student_code);
    $check_stmt->execute();
    $check_stmt->store_result();
    
    if ($check_stmt->num_rows > 0) {
        die("Username or Student ID already exists!");
    }
    $check_stmt->close();
    
   
    $insert_sql = "INSERT INTO students (
        username, password, email, full_name, ic_passport, student_code,
        faculty_code, programme_code, campus, semester, gender, level, mode,
        nationality, origin_country, address, postcode, phone, mobile,
        scholarship, photo_path
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param(
        "sssssssssssssssssssss",
        $username, $password, $email, $full_name, $ic_passport, $student_code,
        $faculty_code, $programme_code, $campus, $semester, $gender, $level, $mode,
        $nationality, $origin_country, $address, $postcode, $phone, $mobile,
        $scholarship, $photo_path
    );
    
    if ($stmt->execute()) {
        $_SESSION['student_id'] = $stmt->insert_id;
        $_SESSION['student_code'] = $student_code;
        header("Location: index.php");
        exit();
    } else {
        
        if ($photo_path && file_exists($photo_path)) {
            unlink($photo_path);
        }
        die("Registration failed: " . $conn->error);
    }
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: register.html");
    exit();
}
?>