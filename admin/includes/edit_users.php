<?php
    if(isset($_GET['id'])){
        $userId = $_GET['id'];
        $query = "SELECT * FROM users WHERE user_id = {$userId}";
        $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($result)){
            $userId = $row['user_id'];
            $username = $row['username'];
            $userPassword = $row['user_password'];
            $userFirstname = $row['user_firstname'];
            $userLastname = $row['user_lastname'];
            $userEmail = $row['user_email'];
            $userImage = $row['user_image'];
            $userRole = $row['user_role'];
        }
    }

 /*   $salt_query = "SELECT randSalt FROM users";
    $salt_query_result = mysqli_query($connection, $salt_query);
    confirm_query($salt_query_result);
    $row = mysqli_fetch_assoc($result);
    $salt = $row['randSalt'];*/
    
//    $cryptedPassword = crypt($userPassword, $salt);

    if (filter_input(INPUT_POST, 'submit')){
        $userFirstname = mysqli_real_escape_string($connection, $_POST['userFirstname']);
        $userLastname = mysqli_real_escape_string($connection, $_POST['userLastname']);
        $userRole = escape($_POST['user_role']);
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $userEmail = mysqli_real_escape_string($connection, $_POST['userEmail']);
//        $postImage = $_FILES['postImage']['name'];
//        $postImageTemp = $_FILES['postImage']['tmp_name'];
        $userPassword = mysqli_real_escape_string($connection, $_POST['userPassword']);
//        $postCommentCount = 4;
        
//        move_uploaded_file($postImageTemp, "../images/$postImage");
/*        $cryptedPassword = crypt($userPassword, $salt); // This needs to be here!
        if ($userPasswordFromDB ==  $userPassword) {
            $cryptedPassword = $userPasswordFromDB;
        }
        */
        
        if(!empty($userPassword)){
            $query = "SELECT user_password FROM users WHERE user_id = {$userId}";
            $result = mysqli_query($connection, $query);
            $row = mysqli_fetch_assoc($result);
            $db_password = $row['user_password'];
                
            $userPassword = password_hash($userPassword, PASSWORD_BCRYPT, array('cost' => 10));
            
            $query = "UPDATE users SET ";
            $query .= "user_firstname = '{$userFirstname}', ";
            $query .= "user_lastname = '{$userLastname}', ";
            $query .= "user_role = '{$userRole}', ";
            $query .= "username = '{$username}', ";
            $query .= "user_email = '{$userEmail}', ";
            $query .= "user_password = '{$userPassword}' ";
            $query .= "WHERE user_id = {$userId}";
            
            $result = mysqli_query($connection, $query);
            confirm_query($result);
            header("Location: users.php");        
        }
        
//        $query = $connection->prepare("INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
//        
//        $query->bind_param("issssssis", $postCategoryId, $postTitle, $postAuthor, 'now()', $postImage, $postContent, $postTags, $postCommentCount, $postStatus);
//        
//        $query->execute();
    }
?>
  
   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" value="<?php echo $userFirstname; ?>" name="userFirstname">
    </div>
    
    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" value="<?php echo $userLastname; ?>" name="userLastname">
    </div>
    
    <div class="form-group">
       <label for="role">Role</label><br>
        <select class="form-control" name="user_role" id="">
            <option value="<?php echo $userRole; ?>"><?php echo $userRole; ?></option>
            <?php
                if($userRole == 'admin'){
                    echo "<option value='subscriber'>subscriber</option>";
                } else {
                    echo "<option value='admin'>admin</option>";
                }
            ?>
        </select>
    </div>
    
<!--
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="postImage">
    </div>
-->
    
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" value="<?php echo $username; ?>" name="username">
    </div>
    
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" value="<?php echo $userEmail; ?>" name="userEmail">
    </div>
    
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" value="<?php echo $userPassword; ?>" name="userPassword">
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Update User">
    </div>
</form>