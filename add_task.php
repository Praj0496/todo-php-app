<?php
require_once 'config.php';

if (isset($_POST['add'])) {
    $task = trim($_POST['task']);
    
    if (!empty($task)) {
        if ($stmt = $db->prepare("INSERT INTO task (task, status) VALUES (?, 'Pending')")) {
            $stmt->bind_param("s", $task);
            
            if ($stmt->execute()) {
                header('location:index.php');
            } else {
                die("Error executing query: " . $stmt->error);
            }
            
            $stmt->close();
        } else {
            die("Error preparing statement: " . $db->error);
        }
    } else {
        die("Task cannot be empty.");
    }
} else {
    die("Invalid request.");
}
?>