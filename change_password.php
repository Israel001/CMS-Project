<?php
/**
 * Created by PhpStorm.
 * User: PBNL
 * Date: 02/09/2018
 * Time: 15:12
 */
?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

<?php

if(!isset($_GET['token']) && !isset($_GET['email'])){
    redirect('index.php');
}

$token = $_GET['token'];
$email = $_GET['email'];

if(!email_exist($email) || !token_exist($token)){
    ?>
    <script>
        alert("Sorry, but you don't have access to this page");
        window.location = "index.php";
    </script>
    <?php
}

//if($stmt = mysqli_prepare($connection, "SELECT username, user_email, token FROM users WHERE token = ?")){
//    mysqli_stmt_bind_param($stmt, "s", $token);
//    mysqli_stmt_execute($stmt);
//    mysqli_stmt_bind_result($stmt, $username, $user_email, $token);
//    mysqli_stmt_num_rows($stmt) === 0 ? redirect('index.php') : mysqli_stmt_fetch($stmt);
//    mysqli_stmt_close($stmt);
//}

if(isset($_POST['recover-submit'])) {
    if (isset($_POST['password']) && isset($_POST['confirmPassword'])) {
        if ($_POST['password'] === $_POST['confirmPassword']) {
            $password = $_POST['password'];
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
            if ($stmt = mysqli_prepare($connection, "UPDATE users SET token='', user_password = '{$hashedPassword}' WHERE user_email = ?")) {
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                if (mysqli_stmt_affected_rows($stmt) >= 1) {
                    redirect('login.php');
                }
                mysqli_stmt_close($stmt);
            }
        } else {
            $_SESSION['message'] = "Your password must be the same";
        }
    }
}

?>

<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                <?php

                if(isset($_SESSION['message'])){
                    $message = $_SESSION['message'];
                    unset($_SESSION['message']);
                    echo "<h3 class='bg bg-danger'>{$message}</h3>";
                }

                ?>

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Change Password</h2>
                            <p>You must change your password here.</p>
                            <div class="panel-body">

                                <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>
                                            <input id="email" name="password" placeholder="Enter password" class="form-control"  type="password" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-ok color-blue"></i></span>
                                            <input id="email" name="confirmPassword" placeholder="Confirm password" class="form-control"  type="password" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div><!-- Body-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->



