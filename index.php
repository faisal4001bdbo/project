<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
</head>
<body>
    <h3 style="color: red;">Sign up</h3><br>
    <form action="index.php" method="post">
        <label style="color: green;">User name</label><br>
        <input type="text" name="name" required><br>
        <label style="color: green;">Email</label><br>
        <input type="email" name="email" required><br>
        <label style="color: green;">Password</label><br>
        <input type="password" name="password" required><br>
        <button type="submit" style="background-color: black; color:green">Sign up</button><br>
    </form>
    <p style="color: red;">Have a account?</p>
    <a href="login.php" target="_self">Log in</a>
</body>
</html>
<?php
session_start();
$conn= new mysqli("127.0.0.1","root","","poster");
$name=$_POST["name"];
$email=$_POST["email"];
$pass=password_hash($_POST["password"],PASSWORD_BCRYPT);

$check=$conn->query("SELECT * FROM users WHERE name='$name'");
if($check->num_rows>0){
    echo"User already exist<br>";
}
else{
    $conn->query("INSERT INTO users(name, email, password) VALUES('$name','$email','$pass')");
    $_SESSION['user_id']=$conn->insert_id;
    $_SESSION['name']=$name;
    header("Location: homepage.php");
    exit();
}
?>