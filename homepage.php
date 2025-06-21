<?php
session_start();
$conn= new mysqli("127.0.0.1","root","","poster");
$user_id = $_SESSION['user_id'];
$name = $_SESSION['name'];

if (isset($_POST['add'])) {
    $text = $conn->real_escape_string($_POST['post']);
    $conn->query("INSERT INTO content (user_id, post) VALUES ($user_id, '$text')");
}


if (isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $text = $conn->real_escape_string($_POST['updated_text']);
    $conn->query("UPDATE content SET post = '$text' WHERE id = $id AND user_id = $user_id");
}


if (isset($_POST['delete'])) {
    $id = (int)$_POST['id'];
    $conn->query("DELETE FROM content WHERE id = $id AND user_id = $user_id");
}


$posts = $conn->query("SELECT * FROM content WHERE user_id = $user_id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head><title>Homepage</title></head>
<body>
    <form method="post">
        <textarea name="post" required></textarea><br>
        <button type="submit" name="add">Post</button>
    </form>

    <h3>Your Posts</h3>
    <?php while ($row = $posts->fetch_assoc()): ?>
        <form method="post">
            <textarea name="updated_text"><?= htmlspecialchars($row['post']) ?></textarea><br>
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <button type="submit" name="update">Update</button>
            <button type="submit" name="delete" onclick="return confirm('Delete this post?')">Delete</button>
        </form>
        <hr>
    <?php endwhile; ?>
</body>
</html>