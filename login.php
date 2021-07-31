<?php
session_start();
include_once "connection.php";

if(isset($_POST["sub"])){
    if(isset($_POST["email"]) && isset($_POST["pass"])){

        $email = $_POST["email"];
        $pass = md5($_POST["pass"]);

        $sql = "SELECT * FROM users WHERE email = '$email' and password = '$pass' ";

        $res = mysqli_query($conn,$sql);
// print_r($res);
        $num = mysqli_num_rows($res) ;

        if($num == 1){

            $_SESSION["logged_in"] = mysqli_fetch_assoc($res);

            $this_user = (object) $_SESSION["logged_in"];

            if($this_user->role_id ==1)
            header("location:admindash.php");

            elseif($this_user->role_id ==2)
            header("location:admindash.php");

        }else{
            echo "Invalid email address!";
        }
    }else{
        echo "error";
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
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
      Email: <input type="email" name="email" placeholder="email"><br><br>
    Password: <input type="password" name="pass" placeholder="Password"><br><br>
    <button type="submit" name="sub">Submit</button><br>
    <a href="fogot_pass.php"><i>Forgotten Password</i></a>
      </form>
  </div>  
</body>
</html>