<?php
session_start();
include_once "connection.php";
// if you are not logged in, then go back
(!isset($_SESSION["logged_in"])) ? 'login.php' : '';

$o_p = ($_SESSION["logged_in"]["password"]);
$n_id = ($_SESSION["logged_in"]["id"]);

//global level
$messages = [];

if (isset($_POST["sub"])) {
    $messages = [];
    if (isset($_POST["old_pass"]) && isset($_POST["new_pass"])) {

        $o_pass = md5($_POST["old_pass"]);
        $n_pass = md5($_POST["new_pass"]);
        //var_dump($o_pass, $o_p);die;
        //check if old password supplied is the same as one in the session(logged_in)
        if ($o_p == $o_pass) {
            $sql = "UPDATE users SET password = '$n_pass' WHERE id= '$n_id'";

            $res = mysqli_query($conn, $sql);
           
            if ($res) {
                $messages['success'] = "Password Updated!";
                //update the $_SESSION["logged_in"]["password"] with the new password
                $_SESSION["logged_in"]["password"] = $n_pass;

            } else {
                $messages['error'] = "Unable to update password!";
            }
        } else {
            $messages['error'] = 'incorrect password';
        }
    }
}

include_once "header.php";
?>

    <div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
            <h2 class="alert alert-danger">
                <?php
                echo  (isset($messages) && !empty($messages['error'])) ?  $messages['error'] : '';
                ?>
            </h2>

            <h2 class="alert alert-success">
                <?php
                echo  (isset($messages) && !empty($messages['success'])) ?  $messages['success'] : '';
                ?>
            </h2>
            Old Password: <input type="password" name="old_pass" placeholder="Old Password"><br><br>
            New Password: <input type="password" name="new_pass" placeholder="New Password"><br><br>
            <button type="submit" name="sub">Change Password</button>
        </form>
    </div>
</body>

</html>