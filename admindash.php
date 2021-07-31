<?php
session_start();
if(!isset ($_SESSION["logged_in"])){
    header("location:login.php");
    }
include_once "connection.php";

$user = (object) $_SESSION["logged_in"];


?>
<!-- here is ok as far you are not include hearder.php -->

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
body{
    text-align: center;
    background-color: lavender;
}
.topnav {
  background-color: #333;
  overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #04AA6D;
  color: white;
}



    </style>
</head>
<body>
  
<div class="topnav">
  <a href="register.php">Register User</a>
  <a href="view.php">View User</a>
  <a href="view_attendance.php">View Attendance</a>
  <a href="take_attendance.php">Take Attendance</a>
  <a href="change_pass.php">Change Password</a>
  <a href="logout.php">Logout</a>
</div>
<h1 class="ad">Welcome to your dashboard admin  <?php echo $user->fullname?></h1> 
</body>
</html>