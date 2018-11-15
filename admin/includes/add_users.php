<?php
    if (filter_input(INPUT_POST, 'submit')){
        $userFirstname = mysqli_real_escape_string($connection, $_POST['userFirstname']);
        $userLastname = mysqli_real_escape_string($connection, $_POST['userLastname']);
        $userRole = escape($_POST['user_role']);
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $userEmail = mysqli_real_escape_string($connection, $_POST['userEmail']);
//        $postImage = $_FILES['postImage']['name'];
//        $postImageTemp = $_FILES['postImage']['tmp_name'];
        $userPassword = mysqli_real_escape_string($connection, $_POST['userPassword']);

        $userPassword = password_hash($userPassword, PASSWORD_DEFAULT, array('cost' => 10));
//        $postCommentCount = 4;
        
//        move_uploaded_file($postImageTemp, "../images/$postImage");
/*        $query = "SELECT randSalt FROM users";
        $result = mysqli_query($connection, $query);
        confirm_query($result);
        $row = mysqli_fetch_assoc($result);
        $randSalt = $row['randSalt'];
        
        $userPassword = crypt($userPassword, $randSalt);*/
        
        if(preg_match('/[^a-zA-Z\d]/', $username) || preg_match('/\d/', $username)){
            ?>
            <script>
                alert("Username must not contain characters or numbers");
                window.location = "users.php?source=add";
            </script>
            <?php
            die();
        }
        
        $username = strtoupper(substr($username, 0, 1)).substr($username, 1, strlen($username));
        
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
                window.location = "users.php?source=add";
            </script>
            <?php
            die();
        } elseif($userEmail == $db_email){
            ?>
            <script>
                alert("Email Already Exist");
                window.location = "users.php?source=add";
            </script>
            <?php
            die();
        } else {
            $query = "INSERT INTO users(user_firstname, user_lastname, username, user_email, user_password, user_role) ";

            $query .= "VALUES('{$userFirstname}', '{$userLastname}', '{$username}', '{$userEmail}', '{$userPassword}', '{$userRole}')";

            $result = mysqli_query($connection, $query);
            
            confirm_query($result);
        
            echo "User Created: <a href='users.php'>View Users</a>";
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
        <input type="text" class="form-control" name="userFirstname">
    </div>
    
    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="userLastname">
    </div>
    
    <div class="form-group">
       <label for="role">Role</label><br>
        <select class="form-control" name="user_role" id="">
            <option value="subscriber">Select a Role</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
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
        <input type="text" class="form-control" name="username">
    </div>
    
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="userEmail">
    </div>
    
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="userPassword">
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Add User">
    </div>
</form>