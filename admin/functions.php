<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function image_placeholder($image=''){
    if(!$image){
        return 'image_placeholder.png';
    } else {
        return $image;
    }
}

function redirect($location){
    if (headers_sent()) {
        die("Redirect failed");
    } else {
        exit(header("Location: ".$location));
    }
    //header("Location: ".$location);
    //exit;
}

function query($query){
    global $connection;
    $result = mysqli_query($connection, $query);
    return confirm_query($result);
}

function isMethod($method=null){
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){
        return true;
    }
    return false;
}

function isLoggedIn(){
    if(isset($_SESSION['user_role'])){
        return true;
    }
    return false;
}

function loggedInUserId(){
    if(isLoggedIn()){
        $username = $_SESSION['username'];
        $result = query("SELECT * FROM users WHERE username = '{$username}'");
        $row = mysqli_fetch_assoc($result);
        $userId = $row['user_id'];
        return mysqli_num_rows($result) > 0 ? $userId : false;
    }
}

function userLikedThisPost($postId){
    global $connection;
    $userId = loggedInUserId();
    $query = "SELECT * FROM likes WHERE user_id = {$userId} AND post_id = {$postId}";
    $result = mysqli_query($connection, $query);
    return mysqli_num_rows($result) > 0 ? true : false;
}

function checkLoggedInAndRedirect($redirectlocation=null){
    if(isLoggedIn()){
        redirect($redirectlocation);
    }
}

function getPostLikes($postId){
    $result = query("SELECT * FROM likes WHERE post_id = {$postId}");
    echo mysqli_num_rows($result) > 0 ? mysqli_num_rows($result) : 0;
}

function fetchRecords($result){
    return mysqli_fetch_assoc($result);
}

function isadmin(){
    global $connection;
    if(isLoggedIn()){
        $result = query("SELECT user_role FROM users WHERE user_id = ".$_SESSION['user_id']."");
        $row = fetchRecords($result);
        if($row['user_role'] == 'admin'){
            return true;
        } else {
            return false;
        }
    }
    return false;
}

function email_exist($email){
    global $connection;
    $query = "SELECT * FROM users WHERE user_email = '{$email}'";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    if(mysqli_num_rows($result) > 0){
        return true;
    } else {
        return false;
    }
}

function escape($string){
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}

function users_online(){
    if(isset($_GET['onlineusers'])){
        global $connection;
        if(!$connection){
            session_start();
            include "../includes/db.php";
            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;
            $time_out = $time - $time_out_in_seconds;

            $query = "SELECT * FROM users_online WHERE session = '{$session}'";
            $result = mysqli_query($connection, $query);
            $count = mysqli_num_rows($result);

            if($count == NULL){
                mysqli_query($connection, "INSERT INTO users_online (session, time) VALUES ('{$session}', {$time})");
            } else {
                mysqli_query($connection, "UPDATE users_online SET time = {$time} WHERE session = '{$session}'");
            }

            $user_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > {$time_out}");
            $count = mysqli_num_rows($user_online_query);
            echo $count;
        }
    }
}

users_online();

function confirm_query($query){
    global $connection;
    if(!$query){
        die("QUERY FAILED. ".mysqli_error($connection));
    }
}

function add_categories(){
    global $connection;
    if(filter_input(INPUT_POST, 'submit')){
        $catTitle = test_data($_POST['catTitle']);
        if($catTitle == "" || empty($catTitle)){
            echo "<font color='red'>This field cannot be empty</font>";
        } else {
            $query = $connection->prepare("INSERT INTO categories (cat_title) VALUES (?)");
            $query->bind_param("s", $catTitle);
            $query->execute();
            $query->close();
        }
    }
}

function test_data($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function display_categories(){
    global $connection;
    $query = "SELECT * FROM categories";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result)){
        $catId = $row['cat_id'];
        $catTitle = $row['cat_title'];
                                            
        echo "<tr>";
        echo "<td>{$catId}</td>";
        echo "<td>{$catTitle}</td>";
        echo "<td><a href='categories.php?delete={$catId}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$catId}'>Edit</a></td>";
        echo "</tr>";
    }
}

function delete_categories(){
    global $connection;
    if(isset($_GET['delete'])){
        $catId = $_GET['delete'];
        $query = "DELETE FROM categories WHERE ";
        $query .= "cat_id = {$catId} ";
        $result = mysqli_query($connection, $query);
        $query = mysqli_query($connection, "DELETE FROM posts WHERE post_category_id = {$catId}");
        header("Location: categories.php");
    }
}

function record_count($table){
    global $connection;
    $query = "SELECT * FROM ".$table;
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);
    confirm_query($result);
    return $count;
}

function record_count_with_condition($table, $column, $condition){
    global $connection;
    $query = "SELECT * FROM ".$table." WHERE ".$column." = '{$condition}'";
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);
    confirm_query($result);
    return $count;
}

function single_record_count_with_condition($column1, $table, $column2, $condition){
    global $connection;
    $query = "SELECT ".$column1." FROM ".$table." WHERE ".$column2." = '{$condition}'";
    $result = mysqli_query($connection, $query);
    confirm_query($result);
    return implode("", fetchRecords($result));
}

function generatePassword(){
    $list = array(
        'A' => 1,
        'B' => 2,
        'C' => 3,
        'D' => 4,
        'E' => 5,
        'F' => 6,
        'G' => 7,
        'H' => 8,
        'I' => 9,
        'J' => 10,
        'K' => 11,
        'L' => 12,
        'M' => 13,
        'N' => 14,
        'O' => 15,
        'P' => 16,
        'Q' => 17,
        'R' => 18,
        'S' => 19,
        'T' => 20,
        'U' => 21,
        'V' => 22,
        'W' => 23,
        'X' => 24,
        'Y' => 25,
        'Z' => 26
    );
    $digits = str_split(implode("", randomNumbers(1, 26, 10)));
    $pass = '';
    foreach($digits as $digit){
        $pass .= array_search($digit, $list);
    }
    $numbers = implode("", randomNumbers(50, 100, 10));
    $password = $pass.$numbers;
    return strtolower($password);
}

function randomNumbers($min, $max, $length){
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $length);
}

function sendEmailForPassword($email, $password){
    global $connection;
    if (email_exist($email)) {
        $token = bin2hex(openssl_random_pseudo_bytes(50));
        if($stmt = mysqli_prepare($connection, "UPDATE users SET token = '{$token}' WHERE user_email = ?")){
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            $mail = new PHPMailer(true);
            try{
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = Config::SMTP_HOST;
                $mail->SMTPAuth = true;
                $mail->Username = Config::SMTP_USER;
                $mail->Password = Config::SMTP_PASS;
                $mail->Port = Config::SMTP_PORT;
                $mail->SMTPSecure = "ssl";
                $mail->CharSet = "UTF-8";

                $mail->setFrom(Config::SMTP_USER, 'Israel Obanijesu');
                $mail->addAddress($email);

                $mail->isHTML(true);
                $mail->Subject = "Your password";
                $mail->Body = '<p> Password: '.$password.' <br> <br> Click here to change your password before you can login
                                    <a href="http://localhost:8080/CMS Project/change_password.php?email='.$email.'&token='.$token.'">
                                        Change password                                    
                                    </a> </p>';
                $mail->send();
                $_SESSION['mailSent'] = true;
            } catch (Exception $e){
                echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
            }
        }
    }
}

function registration($firstname, $lastname, $username, $email){
    global $connection;
    $firstname = mysqli_real_escape_string($connection, $firstname);
    $lastname = mysqli_real_escape_string($connection, $lastname);
    $username = mysqli_real_escape_string($connection, $username);
    $email = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, generatePassword());
    //$password = mysqli_real_escape_string($connection, $password);

    //$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
    if(preg_match('/[^a-zA-Z\d]/', $username) || preg_match('/\d/', $username)){
        ?>
        <script>
            alert("Username must not contain characters or numbers");
            window.location = "registration.php";
        </script>
        <?php
        die();
    }

    $username = ucfirst($username);

    $query = "SELECT * FROM users";
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($result)){
        $db_username = $row['username'];
        $db_email = $row['user_email'];
    }

    if($username == $db_username){
        ?>
        <script>
            alert("Username Already Exist");
            window.location = "registration.php";
        </script>
        <?php
        die();
    } elseif($email == $db_email){
        ?>
        <script>
            alert("Email Already Exist <a href='index.php'>Login?</a>");
            //window.location = "registration.php";
        </script>
        <?php
        die();
    } else {
        $query = "INSERT INTO users(user_firstname, user_lastname, username, user_password, user_email, user_role) ";

        $query .= "VALUES('{$firstname}', '{$lastname}', '{$username}', '{$password}', '{$email}', 'subscriber')";

        query($query);

        sendEmailForPassword($email, $password);
    }
}

function checkToken($username){
    if (single_record_count_with_condition("token", "users", "username", $username) > 0) {
        return true;
    }
    return false;
}

function login($username, $password){
    global $connection;
    if(!empty($username) && !empty($password)){
        if(!checkToken($username)){
            $username = trim($username);
            $password = trim($password);

            $username = mysqli_real_escape_string($connection, $username);
            $password = mysqli_real_escape_string($connection, $password);

            $query = "SELECT * FROM users WHERE username = '{$username}'";
            $result = mysqli_query($connection, $query);

            confirm_query($result);

            while($row = mysqli_fetch_assoc($result)){
                $userId = $row['user_id'];
                $db_username = $row['username'];
                $db_password = $row['user_password'];
                $userFirstname = $row['user_firstname'];
                $userLastname = $row['user_lastname'];
                $userEmail = $row['user_email'];
                $userRole = $row['user_role'];
            }

            if(password_verify($password, $db_password) || $password == $db_password){
                $_SESSION['user_id'] = $userId;
                $_SESSION['username'] = $db_username;
                $_SESSION['firstname'] = $userFirstname;
                $_SESSION['lastname'] = $userLastname;
                $_SESSION['user_role'] = $userRole;
                $_SESSION['user_email'] = $userEmail;
                $_SESSION['user_password'] = $password;

                ?>
                <script> window.location = "admin"; </script>
                <?php

                //redirect("../CMS Project/admin");
            } else {
                ?>
                <script>
                    alert("Your password is incorrect")
                </script>
                <?php
            }
        }
    } else {
        ?>
        <script>
            alert("Something went wrong. Pls try again with your correct details")
        </script>
        <?php
    }
}

?>