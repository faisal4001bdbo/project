
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h4 style="color: red;">Login</h4><br>
    <form action="login.php" method="post">
        <label style="color: green;">User name</label><br>
        <input type="text" name="name" required><br>
        <label style="color: green;">Password</label><br>
        <input type="password" name="password" required><br>
        <input type="submit" name="b" value="bob">Login</input><br>
    </form>
     <p style="color: red;">new user?</p>
    <a href="index.php" target="_self">sign up</a>
</body>
</html>

<?php
session_start();
$conn= new mysqli("127.0.0.1","root","","poster");
$name=$_POST["name"];
$password=$_POST["password"];
$user=$conn->query("SELECT * FROM users WHERE name='$name'")->fetch_assoc();
if($user && password_verify($password,$user['password'])){
    $_SESSION['user_id']=$user['id'];
    $_SESSION['name']=$user['name'];
    if("b"==!NULL){
    header("Location: homepage.php");
    echo"success";
    exit();
    }
}
else{
    echo"you failed";
}
?>