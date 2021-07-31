<?php
session_start();
if(!isset ($_SESSION["logged_in"])){
    header("location:login.php");
    }
include_once "connection.php";
include_once "header.php";

$user = (object) $_SESSION["logged_in"];

if(isset($_POST["sub"])){
    $email = $_POST["email"];
    $uniq = $_POST["uniq"];


$sql1 = "SELECT * FROM users WHERE email='$email' and unique_code = '$uniq'";
$rest = mysqli_query($conn,$sql1);
if($rest){
    $sql = "INSERT INTO attend (email,unique_code) VALUES('$email', '$uniq')";
    $res = mysqli_query($conn,$sql);
    if($res){
        echo "Attendance Taken";
    }else{
        echo "unable to take Attendance";
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

    <style>
body{
    text-emphasis: none;
    text-align: center;
    color: burlywood;
}
#div{
    border: burlywood;
    border-radius: 8px solid white;
}


    </style>
</head>
<h1 class="dash">Welcome to your dashboard <?php echo $user->fullname?> </h1>
    <h3 id="att">Please input your unique code to take your attendance</h3>
<body>  
 <div id="div">
     <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
         <input type="email" name="email" placeholder="Email"><br><br>
         <input type="text" name="uniq" placeholder="Your Unique Code"><br><br>
         <button type="submit" name="sub">Take Attendance</button>
     </form>
 </div>   
</body>
</html>