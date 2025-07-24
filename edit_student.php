<?php
require_once 'config.php';

$conn = getDBConnection();

if (isset($_GET['id'])) {
    $student_id = intval($_GET['id']);
    $sql = "SELECT * FROM students WHERE student_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $student = $result->fetch_assoc();

    if (!$student) {
        echo "❌ Student not found.";
        exit();
    }
} else {
    echo "⚠️ No student ID provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Student</title>
  <style>
    :root {
      --primary-color: #981d1d;
      --background-dark: #fff;
      --input-bg: #f4f4f4;
      --text-dark: #333;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-image: url('univer.jpg');
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    body::before {
      content: "";
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background-image: url('univer.jpg');
      background-size: cover;
      background-position: center;
      filter: blur(8px);
      z-index: -1;
    }

    .form-container {
      background-color: var(--background-dark);
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 500px;
      color: var(--text-dark);
    }

    h2 {
      margin-bottom: 20px;
      text-align: center;
      color: var(--primary-color);
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      margin-top: 15px;
    }

    input, select {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      background-color: var(--input-bg);
      font-size: 1rem;
    }

    .btn {
      margin-top: 20px;
      background-color: var(--primary-color);
      color: white;
      padding: 12px;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
    }

    .btn:hover {
      background-color: #7a1414;
    }

    @media (max-width: 500px) {
      .form-container {
        padding: 25px 20px;
      }
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Edit Student</h2>
    <form action="update_student.php" method="post">
      <input type="hidden" name="student_id" value="<?= $student['student_id'] ?>">

      <label for="name">Full Name</label>
      <input type="text" name="name" value="<?= htmlspecialchars($student['full_name']) ?>" required>

      <label for="student_code">Student Code</label>
      <input type="text" name="student_code" value="<?= htmlspecialchars($student['student_code']) ?>" required>

      <label for="email">Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" required>

      <label for="programme_code">Programme Code</label>
      <input type="text" name="programme_code" value="<?= htmlspecialchars($student['programme_code']) ?>">

      <label for="faculty_code">Faculty Code</label>
      <input type="text" name="faculty_code" value="<?= htmlspecialchars($student['faculty_code']) ?>">

      <label for="semester">Semester</label>
      <input type="text" name="semester" value="<?= htmlspecialchars($student['semester']) ?>">

      <label for="campus">Campus</label>
      <input type="text" name="campus" value="<?= htmlspecialchars($student['campus']) ?>">

      <label for="gender">Gender</label>
      <input type="text" name="gender" value="<?= htmlspecialchars($student['gender']) ?>">

      <button class="btn" type="submit">Save Changes</button>
    </form>
  </div>
</body>
</html>
