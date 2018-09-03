   <?php
        if(isset($_GET['id'])){
            $postId = escape($_GET['id']);
        }

        $query = "SELECT * FROM posts WHERE post_id = {$postId}";
            $result = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($result)){
                $postId = $row['post_id'];
                $postAuthor = $row['post_author'];
                $postUser = $row['post_user'];
                $postTitle = $row['post_title'];
                $postCatId = $row['post_category_id'];
                $postStatus = $row['post_status'];
                $postImage = $row['post_image'];
                $postContent = $row['post_content'];
                $postTags = $row['post_tags'];
                $postComments = $row['post_comment_count'];
                $postDate = $row['post_date'];
            }
        
        if(filter_input(INPUT_POST, 'submit')){
            $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = {$postId}";
            $result = mysqli_query($connection, $query);
            
            $postTitle = mysqli_real_escape_string($connection, $_POST['postTitle']);
            $postAuthor = mysqli_real_escape_string($connection, $_POST['postAuthor']);
            $postCategoryId = escape($_POST['post_category']);
            $postStatus = escape($_POST['postStatus']);
            $postImage = $_FILES['image']['name'];
            $postImageTemp = $_FILES['image']['tmp_name'];
            $postTags = escape($_POST['postTags']);
            $postContent = mysqli_real_escape_string($connection, $_POST['postContent']);
//            $postDate = date('d-m-y');
            
            move_uploaded_file($postImageTemp, "../images/{$postImage}");
            
            if(empty($postImage)){
                $select_image = "SELECT * FROM posts WHERE post_id = {$postId}";
                $select_image_result = mysqli_query($connection, $select_image);
                while($rows = mysqli_fetch_assoc($select_image_result)){
                    $postImage = $rows['post_image'];
                }
            }
            
            $query = "UPDATE posts SET ";
            $query .= "post_title = '{$postTitle}', ";
            $query .= "post_category_id = {$postCategoryId}, ";
            $query .= "post_date = now(), ";
            $query .= "post_author = '{$postAuthor}', ";
            $query .= "post_user = {$postUser}, ";
            $query .= "post_status = '{$postStatus}', ";
            $query .= "post_tags = '{$postTags}', ";
            $query .= "post_content = '{$postContent}', ";
            $query .= "post_image = '{$postImage}' ";
            $query .= "WHERE post_id = {$postId}";
            
            $query = mysqli_query($connection, $query);
            confirm_query($query);
//            header("Location: posts.php");
            
            echo "<p class='bg gb-success'>Post Updated. <a href='../post.php?id={$postId}'>View post</a> or <a href='posts.php'>Edit more posts</a></p>";
            
        }
    ?>

   <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $postTitle; ?>" type="text" class="form-control" name="postTitle">
    </div>
    
    <div class="form-group">
       <label for="category">Post Category</label><br>
        <select class="form-control" name="post_category" id="">
            <?php
                $query = "SELECT * FROM categories";
                $result = mysqli_query($connection, $query);
                confirm_query($result);

                while($row = mysqli_fetch_assoc($result)){
                    $catId = $row['cat_id'];
                    $catTitle = $row['cat_title'];
                    if ($catId == $postCatId) {
                        echo "<option value='{$catId}' selected>$catTitle</option>";
                    } else {
                        echo "<option value='{$catId}'>$catTitle</option>";
                    }

                }
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="author">Post Author</label>
        <select class="form-control" name="postAuthor" id="">
            <?php
                $query = "SELECT * FROM users";
                $result = mysqli_query($connection, $query);
                confirm_query($result);
                /*$author_query = "SELECT user_id FROM users WHERE username = {$postAuthor}";
                $author_query_result = mysqli_query($connection, $author_query);
                $row = mysqli_fetch_assoc($author_query_result);
                $postUserId = $row['user_id'];*/

                while($row = mysqli_fetch_assoc($result)){
                    $userId = $row['user_id'];
                    $username = $row['username'];
                    if ($username == $postAuthor) {
                        echo "<option value='{$username}' selected>$username</option>";
                    } else {
                        echo "<option value='{$username}'>$username</option>";
                    }

                }
            ?>
        </select>
    </div>
    
    <div class="form-group">
        <label for="status">Post Status</label><br>
        <select name="postStatus" id="" class="form-control">
            <option value="<?php echo $postStatus; ?>">Select a status</option>
            
            <?php
                if($postStatus == 'published'){
                    echo "<option value='draft'>Draft</option>";
                    echo "<option value='published'>Published</option>";
                } else {
                    echo "<option value='published'>Published</option>";
                    echo "<option value='draft'>Draft</option>";
                }
            ?>
            
        </select>
   </div>
    
    <div class="form-group">
        <label for="image">Post Image</label><br>
        <img width="100" src="../images/<?php echo $postImage; ?>"><br><br>
        <input type="file" name="image">
    </div>
    
    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input value="<?php echo $postTags; ?>" type="text" class="form-control" name="postTags">
    </div>
    
    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea class="form-control" name="postContent" id="body" cols="30" rows="10"><?php echo $postContent; ?></textarea>
    </div>
    
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Update Post">
    </div>
</form>
