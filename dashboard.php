<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); 
    exit();
}


require 'includes/db.php';

$user_id = $_SESSION['user_id'];


$query = "SELECT * FROM tasks WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$tasks = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>Dashboard</title>
</head>
<body>

    <div class="container">

        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?></h2>
        
        <div class="sidebar">
        <div class="hamburger">☰</div>
        <span class="close-icon">✖</span>
        <a href="profile.php">Profile</a>
        <a href="#" id="darkModeToggle">Dark Mode</a>
        <a href="logout.php">Logout</a>

        </div>

        <form action="add_task.php" method="POST">
            <input type="text" name="task" placeholder="What you have to do..." required>
            <button type="submit">Add Task</button>
        </form>

  
        <ul class="task-list">
        <?php while ($task = $tasks->fetch_assoc()): ?>
        <li class="task-item">
            <span class="task-text"><?php echo htmlspecialchars($task['task']); ?></span>
            <span class="task-time"><?php echo date("F j, Y, g:i a", strtotime($task['created_at'])); ?></span>
            <a class="delete-button" href="delete_task.php?id=<?php echo $task['id']; ?>">Delete</a>
        </li>
        <?php endwhile; ?>
        </ul>

    </div>
</body>
</html>
