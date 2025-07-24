<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #981d1d;
      --bg-dark: #ffffff;
      --card-bg: #981d1d;
      --text-light: #ffffff;
      --btn-light: #ffffff;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: var(--bg-dark);
      color: var(--text-light);
      height: 100vh;
      background-image: url('univer.jpg');
      background-size: cover;
      background-position: center;
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

    .dashboard-container {
      background-color: var(--card-bg);
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      max-width: 450px;
      width: 90%;
      text-align: center;
      z-index: 1;
    }

    .logo {
      width: 80px;
      height: 80px;
      margin-bottom: 20px;
    }

    h1 {
      margin-bottom: 15px;
      color: var(--text-light);
    }

    .dashboard-container p {
      margin-bottom: 30px;
      font-size: 1.1rem;
    }

    a.button {
      display: inline-block;
      background-color: var(--btn-light);
      color: var(--primary-color);
      padding: 12px 20px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    a.button:hover {
      background-color: #f2f2f2;
      transform: translateY(-2px);
    }

    @media (max-width: 480px) {
      .dashboard-container {
        padding: 30px 20px;
      }
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <img src="logo.png" alt="Logo" class="logo">
    <h1>Welcome, <?= htmlspecialchars($_SESSION['admin_username']) ?>!</h1>
    <p>Manage student records and settings from here.</p>
    <a href="admin_students.php" class="button"><i class="fas fa-users-cog"></i> Manage Students</a>
    <a href="admin_chat.php" class="button"><i class="fas fa-comments"></i> Manage Chat</a>

  </div>
</body>
</html>
