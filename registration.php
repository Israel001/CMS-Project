<?php  include "includes/db.php"; ?>
 <?php  include "includes/header.php"; ?>

<?php require './vendor/autoload.php'; ?>

<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>
    
    
<?php
    
    require 'vendor/autoload.php';

    $dotenv = new \Dotenv\Dotenv(__DIR__);
    $dotenv->load();
    
    $options = array(
        'cluster' => 'apl',
        'encrypted' => true
    );


    $pusher = new Pusher\Pusher(getenv('APP_KEY'), getenv('APP_SECRET'), getenv('APP_ID'), $options);
    
    if(isset($_POST['submit'])){
        
        $firstname = trim($_POST['firstname']);
        $lastname = trim($_POST['lastname']);
        $email = trim($_POST['email']);
        $username = trim($_POST['username']);

        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        
        $error = [
            
            'firstname' => '',
            'lastname' => '',
            'username' => ''
                        
        ];
        
        if(strlen($firstname) < 4){
            $error['firstname'] = "Firstname cannot be less than four characters";
        }
        
        if(strlen($lastname) < 4){
            $error['lastname'] = "Lastname cannot be less than four characters";
        }
        
        if(strlen($username) < 4){
            $error['username'] = "Username cannot be less than four characters";
        }
        
        foreach($error as $key => $value){
            if(empty($value)){
                unset($error[$key]);
            }
        }
        
        if(empty($error)){
            if (registration($firstname, $lastname, $username, $email)) {

                unset($_SESSION['firstname']);
                unset($_SESSION['lastname']);
                unset($_SESSION['username']);
                unset($_SESSION['email']);

                $data['message'] = $username;

                $pusher->trigger('notifications', 'new_user', $data);

                $message = "Registration Completed Successfully. Please check your Email.";
            }
        }
        
    } else {
        $message = "";
    }
    $_SESSION['mailSent'] = false;
?>

    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                    <?php if($_SESSION['mailSent'] == false): ?>
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                      <h6 class="text-center"><?php echo $message; ?></h6>
                       <div class="form-group">
                            <label for="firstname" class="sr-only">Firstname</label>
                            <input type="text" name="firstname" required id="firstname" class="form-control" placeholder="Enter Your Firstname" autocomplete="on" value="<?php echo isset($_SESSION['firstname']) ? $_SESSION['firstname'] : ''; ?>">
                           <p><?php echo isset($error['firstname']) ? $error['firstname'] : ''; ?></p>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">Lastname</label>
                            <input type="text" name="lastname" required id="lastname" class="form-control" placeholder="Enter Your Lastname" autocomplete="on" value="<?php echo isset($_SESSION['lastname']) ? $_SESSION['lastname'] : ''; ?>">
                            <p><?php echo isset($error['lastname']) ? $error['lastname'] : ''; ?></p>
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" required id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="on" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>">
                            <p><?php echo isset($error['username']) ? $error['username'] : ''; ?></p>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" required id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>">
                        </div>
<!--                         <div class="form-group">-->
<!--                            <label for="password" class="sr-only">Password</label>-->
<!--                            <input type="password" name="password" required id="key" class="form-control" placeholder="Password" onkeyup="liveCheck(this.value);">-->
<!--                            <span style="float: right;" id="livecheck"></span>-->
<!--                        </div>-->
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                    <?php else: ?>
                    <h2> Please check your email </h2>
                    <?php endif; ?>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>


<script>
    function liveCheck(str){
        if(str.length == 0){
            document.getElementById("livecheck").innerHTML = "";
            return;
        }
        if(window.XMLHttpRequest){
            let xmlhttp = new XMLHttpRequest();
        } else {
            let xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("livecheck").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "livecheck.php?q="+str, true);
        xmlhttp.send();
    }
</script>



<?php include "includes/footer.php";?>
