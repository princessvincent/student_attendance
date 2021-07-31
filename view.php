<?php
session_start();
if(!isset ($_SESSION["logged_in"])){
header("location:login.php");
}
include_once "connection.php";
include_once "header.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <table border="1">
     <thead>
         <tr>
         <th>role_id</th>
             <th>Fullname</th>
             <th>email</th>
         </tr>
     </thead>
     <tbody>
         <?php 
         $sql = "SELECT * FROM users";
$rest  = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($rest)){
         ?>
         <tr>
         <td><?php echo $row["role_id"]?></td>
<td><?php echo $row["fullname"]?></td>
<td><?php echo $row["email"]?></td>
         </tr>
         <?php }?>
     </tbody>
 </table>   
</body>
</html>