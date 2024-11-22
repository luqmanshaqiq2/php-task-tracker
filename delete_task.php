<?php
require 'includes/auth.php';
require 'includes/db.php';

if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    $query = "DELETE FROM tasks WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $task_id);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    }
}
?>
