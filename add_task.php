<?php
session_start();
require 'includes/db.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $task = $_POST['task'];
    $user_id = $_SESSION['user_id']; 

    if (!empty($task)) {
        $query = "INSERT INTO tasks (user_id, task) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("is", $user_id, $task);

        if ($stmt->execute()) {
            header("Location: dashboard.php"); 
            exit();
        } else {
            echo "Error adding task: " . $stmt->error;
        }
    } else {
        echo "Task cannot be empty.";
    }
}
?>
