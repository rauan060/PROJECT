<?php
header('Content-Type: application/json');
require_once 'config.php';

try {
    $conn = getDBConnection();
    
     
    $query = "SELECT 
                c.id AS message_id,
                c.student_id,
                c.message AS content,
                c.sent_at AS timestamp,
                s.username,
                s.student_code,
                s.photo_path
              FROM chat c
              JOIN students s ON c.student_id = s.student_id
              ORDER BY c.sent_at DESC";
    
    $result = $conn->query($query);
    
    if (!$result) {
        throw new Exception("Ошибка базы данных: " . $conn->error);
    }
    
    $messages = [];
    while ($row = $result->fetch_assoc()) {
        $messages[] = [
            'message_id' => $row['message_id'],
            'student_id' => $row['student_id'],
            'content' => nl2br(htmlspecialchars($row['content'])),
            'timestamp' => $row['timestamp'],
            'username' => htmlspecialchars($row['username']),
            'student_code' => htmlspecialchars($row['student_code']),
            'avatar' => $row['photo_path'] ? 'uploads/students/' . $row['photo_path'] : 'default_avatar.png'
        ];
    }
    
    echo json_encode($messages);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    if (isset($conn)) $conn->close();
}
?>