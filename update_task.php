// update_task.php

<?php
require_once 'config.php';

if (isset($_GET['task_id']) && !empty($_GET['task_id']) && is_numeric($_GET['task_id'])) {
    $task_id = (int) $_GET['task_id'];

    // Prepare the statement
    $stmt = $db->prepare("UPDATE task SET status = 'Done' WHERE task_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $task_id);
        
        if ($stmt->execute()) {
            header('location: index.php');
        } else {
            die("Error: " . $stmt->error);
        }

        $stmt->close();
    } else {
        die("Error: " . $db->error);
    }
} else {
    die("Invalid task_id");
}
?>
