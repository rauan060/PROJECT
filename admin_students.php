<?php
require_once 'config.php';

$conn = getDBConnection();
$result = $conn->query("SELECT * FROM students");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Manage Students</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #981d1d;
      --bg-dark: #ffffff;
      --text-light: #ffffff;
      --table-bg: rgba(255, 255, 255, 0.95);
      --header-bg: #981d1d;
      --hover-color: #f5f5f5;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-image: url('univer.jpg');
      background-size: cover;
      background-position: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 60px 20px;
      min-height: 100vh;
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

    h1 {
      color: var(--text-light);
      background-color: var(--primary-color);
      padding: 20px 40px;
      border-radius: 10px;
      margin-bottom: 30px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
      text-align: center;
    }

    table {
      width: 100%;
      max-width: 1200px;
      background-color: var(--table-bg);
      border-collapse: collapse;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    thead {
      background-color: var(--header-bg);
      color: var(--text-light);
    }

    th, td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
      font-size: 0.95rem;
    }

    tbody tr:hover {
      background-color: var(--hover-color);
    }

    a {
      color: var(--primary-color);
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }

    @media (max-width: 768px) {
      table, thead, tbody, th, td, tr {
        display: block;
      }

      thead tr {
        display: none;
      }

      tr {
        margin-bottom: 15px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        padding: 10px;
      }

      td {
        position: relative;
        padding-left: 50%;
        border: none;
      }

      td::before {
        position: absolute;
        top: 12px;
        left: 15px;
        width: 45%;
        white-space: nowrap;
        font-weight: bold;
        color: #666;
      }

      td:nth-of-type(1)::before { content: "ID"; }
      td:nth-of-type(2)::before { content: "Username"; }
      td:nth-of-type(3)::before { content: "Full Name"; }
      td:nth-of-type(4)::before { content: "Email"; }
      td:nth-of-type(5)::before { content: "Student Code"; }
      td:nth-of-type(6)::before { content: "Programme"; }
      td:nth-of-type(7)::before { content: "Faculty"; }
      td:nth-of-type(8)::before { content: "Campus"; }
      td:nth-of-type(9)::before { content: "Semester"; }
      td:nth-of-type(10)::before { content: "Gender"; }
      td:nth-of-type(11)::before { content: "Actions"; }
    }
  </style>
</head>
<body>
  <h1><i class="fas fa-user-graduate"></i> Student Management Panel</h1>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Full Name</th>
        <th>Email</th>
        <th>Student Code</th>
        <th>Programme</th>
        <th>Faculty</th>
        <th>Campus</th>
        <th>Semester</th>
        <th>Gender</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
          <td><?= $row['student_id']; ?></td>
          <td><?= $row['username']; ?></td>
          <td><?= $row['full_name']; ?></td>
          <td><?= $row['email']; ?></td>
          <td><?= $row['student_code']; ?></td>
          <td><?= $row['programme_code']; ?></td>
          <td><?= $row['faculty_code']; ?></td>
          <td><?= $row['campus']; ?></td>
          <td><?= $row['semester']; ?></td>
          <td><?= $row['gender']; ?></td>
          <td>
            <a href="edit_student.php?id=<?= $row['student_id']; ?>"><i class="fas fa-edit"></i> Edit</a> |
            <a href="delete_student.php?id=<?= $row['student_id']; ?>" onclick="return confirm('Are you sure?');"><i class="fas fa-trash-alt"></i> Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <?php $conn->close(); ?>
</body>
</html>
