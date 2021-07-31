<?php
session_start();
include_once "connection.php";

if (isset($_POST["sub"])) {
    $email = $_POST["email"];
    $pass = md5($_POST["pass"]);

$sql = "SELECT * FROM users WHERE email = '$email'";
$res = mysqli_query($conn,$sql);
if($res){
    $sql1 = "UPDATE users SET password = '$pass' WHERE email = '$email'";
    $rest = mysqli_query($conn,$sql1);
    if($rest){
        echo "your New Password is ready!";
    }else{
        echo "Unable to get you a new password!";
    }
}
}


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            Email: <input type="email" name="email" placeholder="Email"><br><br>
            Password: <input type="password" name="pass" placeholder="Password"><br><br>
            <button type="submit" name="sub">Submit</button>
            <a href="login.php">Login Here</a>
        </form>
    </div>
</body>

</html>