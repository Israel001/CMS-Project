<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php

//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 

require './vendor/autoload.php'; //Load Composer's autoloader

if(!isMethod('get') && !isset($_GET['forgot'])){
    redirect('index.php');
}

if(isMethod('post')){
    if(isset($_POST['email'])){
        $email = $_POST['email'];
        $length = 50;
        $token = bin2hex(openssl_random_pseudo_bytes($length));
        if(email_exist($email)){
            if($stmt = mysqli_prepare($connection, "UPDATE users SET token = '{$token}' WHERE user_email = ?")){
                mysqli_stmt_bind_param($stmt, "s", $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                
                $mail = new PHPMailer(true); //Passing 'true' enables exceptions
                //echo get_class($mail);
                try{
                    //Server Settings
                    $mail->SMTPDebug = 0; //Disable verbose debug output
                    $mail->isSMTP(); //Set mailer to use SMTP
                    $mail->Host = Config::SMTP_HOST; //Specify main and backup SMTP servers
                    $mail->SMTPAuth = true; //Enable SMTP authentication
                    $mail->Username = Config::SMTP_USER; //SMTP username
                    $mail->Password = Config::SMTP_PASS; //SMTP password
                    $mail->Port = Config::SMTP_PORT; //TCP port to connect to
                    $mail->SMTPSecure = "ssl"; //Enable SSL encryption
                    $mail->Charset = "UTF-8";
                    
                    //Recipients
                    $mail->setFrom(Config::SMTP_USER, 'Israel Obanijesu');
                    $mail->addAddress($email); //Add a recipient
                    
                    //Content
                    $mail->isHTML(true); //Set email format to HTML
                    $mail->Subject = 'This is a test email';
                    $mail->Body = '<p>Please click to reset your password
                    <a href="http://localhost:8080/CMS Project/reset.php?email='.$email.'&token='.$token.'">
                    Reset Password
                    </a>
                    </p>
                    ';
                    
                    $mail->send();
                    $mailSent = true;
                } catch (Exception $e){
                    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
                }
            } 
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
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                                
                                <?php if(!isset($mailSent)): ?>
                                
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                                
                                <?php else: ?>
                                
                                <h2>Please check your email</h2>
                                
                                <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

