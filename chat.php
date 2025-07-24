<?php
$conn = new mysqli("localhost", "root", "", "group_project_web");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = $_POST['username'] ?? '';
$chat_message = $_POST['chat_message'] ?? '';

$sql = "INSERT INTO chat (username, chat_message) VALUES ('$username', '$chat_message')";
if ($conn->query($sql) === TRUE) {
    echo "✅ Chat message sent!";
} else {
    echo "❌ Error: " . $conn->error;
}
$conn->close();
?>
<a href="chat.html">Back to Chat</a>
