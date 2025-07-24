<?php
require_once 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.html");
    exit();
}

$conn = getDBConnection();
$result = $conn->query("SELECT * FROM chat ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Chat</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body>
  <div class="container">
    <h1>💬 Manage Chat Messages</h1>
    <table border="1" cellpadding="10" cellspacing="0">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Message</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td><?= htmlspecialchars($row['chat_message']) ?></td>
            <td><?= $row['created_at'] ?></td>
            <td>
              <a href="delete_chat.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this message?');">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <a href="admin_dashboard.php" class="btn">← Back to Dashboard</a>
  </div>
</body>
</html>
