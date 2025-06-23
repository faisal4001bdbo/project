<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h4 style="color: red;">Login</h4><br>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="" method="post">
        <label style="color: green;">User name</label><br>
        <input type="text" name="name" required><br>
        <label style="color: green;">Password</label><br>
        <input type="password" name="password" required><br>
        <input type="submit" name="b" value="Login"><br>
    </form>
    <p style="color: red;">New user?</p>
    <a href="index.php" target="_self">Sign up</a>
</body>
</html>
<?php
session_start();
$conn = new mysqli("127.0.0.1", "root", "", "poster");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $password = $_POST["password"];

    $user = $conn->query("SELECT * FROM users WHERE name='$name'")->fetch_assoc();
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        
      
        if (isset($_POST['b'])) {
            header("Location: homepage.php");
            exit();
        }
    } else {
        $error = "Login failed. Invalid name or password.";
    }
}
?>

