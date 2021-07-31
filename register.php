
<?php
session_start();
if(!isset ($_SESSION["logged_in"])){
    header("location:login.php");
    }
// $_SESSION["logged_in"] = mysqli_fetch_assoc($res);
include_once "header.php";
include_once "connection.php";

if(isset($_POST["sub"])){
    if(isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["sel"]) && isset($_POST["password"])){

        $full = $_POST["fullname"];
        $email= $_POST["email"];
        $sel = $_POST["sel"];
        // $uniq = $_POST["uniq"];
        $pass = md5($_POST["password"]);

if(filter_var("$email, FILTER_VALIDATE_EMAIL")){
    $email_error = "Invalid email address";
}

$sql = "SELECT * FROM users WHERE email = '$email'";
$res = mysqli_query($conn,$sql);
if(mysqli_num_rows($res) == 1){
echo "Sorry..... Email Already exist!";
}elseif(strlen($pass) < 8){
    echo "Password should be minimuim of 8 charaters";
}else{
$unique_id = generatid();
$sql1 = "INSERT INTO users (role_id,fullname,email,unique_code, password) VALUES ('$sel','$full', '$email','$unique_id', md5('$pass'))";

    $rest = mysqli_query($conn,$sql1);
    // print_r(mysqli_error($conn));
    if($rest){
        echo "Registration successful! <br> This is your unique id keep it safe <br>".$unique_id;

        // header("location:admindash.php");
    }else{
        echo "Unable to register";
    }
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
    <?php
    function generatid(){
        $lenght = 8;
        $str = $_SESSION["logged_in"]["email"];
        $rand = substr(str_shuffle($str),0,$lenght);
        return $rand;
    ?>
    
    <?php  } ?>
  <div>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
        <!-- <input type="hidden" name="uniq" placeholder="Fullname" required><br><br> -->
         Fullname:  <input type="text" name="fullname" placeholder="Fullname" required><br><br>
          Email: <input type="email" name="email" placeholder="Email" required><br><br>
        <label for="id">Choose Role</label><br>
        <select name="sel">
            <?php
            $sql = "SELECT * FROM roles";
$res = mysqli_query($conn,$sql);

while($row = mysqli_fetch_assoc($res)){

            ?>
            <option value="<?php echo $row["id"]?>"><?php echo strtoupper($row["name"]) ?></option>
            <?php } ?>
        </select><br><br>
Password: <input type="password" name="password" placeholder="Password"><br><br>
<button type="submit" name="sub">Submit</button>
      </form>
  </div>  
</body>
</html>