<?php

    if(!isset($_GET['username']) && $_SESSION['user_role'] == 'subscriber'){
        redirect('index.php');
    }

    if (filter_input(INPUT_POST, 'submit')){
        $postTitle = mysqli_real_escape_string($connection, $_POST['postTitle']);
        $postCategoryId = escape($_POST['post_category']);
        
        if(isset($_GET['username'])){

        } else {
            $postStatus = escape($_POST['postStatus']);
            $postAuthor = mysqli_real_escape_string($connection, $_POST['postAuthor']);
        }
        
        $postImage = $_FILES['postImage']['name'];
        $postImageTemp = $_FILES['postImage']['tmp_name'];
        $postTags = escape($_POST['postTags']);
        $postContent = mysqli_real_escape_string($connection, $_POST['postContent']);
        $postDate = date('d-m-y');
//        $postCommentCount = 4;
        
        move_uploaded_file($postImageTemp, "../images/$postImage");
        
        if(isset($_GET['username'])){
            $username = escape($_GET['username']);
            $userId = $_SESSION['user_id'];
            $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_user, post_date, post_image, post_content, post_tags, post_status) ";
        
            $query .= "VALUES({$postCategoryId}, '{$postTitle}', '{$username}', {$userId}, now(), '{$postImage}', '{$postContent}', '{$postTags}', 'draft')";

            $result = mysqli_query($connection, $query);
            
            confirm_query($result);
        
            $postId = mysqli_insert_id($connection);
        
            echo "<p class='bg gb-success'>Post Added. <a href='../post.php?id={$postId}'>View post</a> or <a href='posts.php?source=add&username={$username}'>Add more posts</a></p>";
        } else {
        
            $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) ";

            $query .= "VALUES({$postCategoryId}, '{$postTitle}', '{$postAuthor}', now(), '{$postImage}', '{$postContent}', '{$postTags}', '{$postStatus}')";

            $result = mysqli_query($connection, $query);
        
//        $query = $connection->prepare("INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
//        
//        $query->bind_param("issssssis", $postCategoryId, $postTitle, $postAuthor, 'now()', $postImage, $postContent, $postTags, $postCommentCount, $postStatus);
//        
//        $query->execute();
        
            confirm_query($result);

            $postId = mysqli_insert_id($connection);

            echo "<p class='bg gb-success'>Post Added. <a href='../post.php?id={$postId}'>View post</a> or <a href='posts.php?source=add'>Add more posts</a></p>";
        }
    }
?>
  
   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="postTitle">
    </div>
    
    <div class="form-group">
       <label for="category">Post Category</label><br>
        <select class="form-control" name="post_category" id="" required>
           <option value="">Select a category</option>
            <?php
                $query = "SELECT * FROM categories";
                $result = mysqli_query($connection, $query);
                confirm_query($result);
                
                while($row = mysqli_fetch_assoc($result)){
                    $catId = $row['cat_id'];
                    $catTitle = $row['cat_title'];
                    
                    echo "<option value='{$catId}'>$catTitle</option>";
                }
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="author">Post Author</label>
        <?php
        if(isset($_GET['username'])){
            $username = escape($_GET['username']);
            echo "<input type='text' name='postAuthor' class='form-control' value='{$username}' disabled> ";
        } else {
            ?>
            <select name="postAuthor" id="" class="form-control" required>

               <option value="">Choose an author</option>

                <?php
                $query = "SELECT * FROM users";
                $result = mysqli_query($connection, $query);
                confirm_query($result);

                while($row = mysqli_fetch_assoc($result)){
                    $userId = $row['user_id'];
                    $username = $row['username'];

                    echo "<option value='{$userId}'>{$username}</option>";
                }
                ?>
            
        </select>
        <?php
        }
        ?>
    </div>
    
    <div class="form-group">
       <label for="role">Post Status</label><br>
       
       <?php
        if(isset($_GET['username'])){
            ?>
            <select class="form-control" name="postStatus" id="" disabled>
                <option value="draft">Select a status</option>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
            <?php
        } else {
            ?>
            <select class="form-control" name="postStatus" id="">
                <option value="draft">Select a status</option>
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
            <?php
        }
        ?>
        
    </div>
    
    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="postImage">
    </div>
    
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" class="form-control" name="postTags">
    </div>
    
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="postContent" id="body" cols="30" rows="10"></textarea>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Publish Post">
    </div>
</form>