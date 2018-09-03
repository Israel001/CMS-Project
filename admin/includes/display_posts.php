   <?php
        include "delete_modal.php";
        if(isset($_POST['submit'])){
            if(isset($_POST['checkBoxArray'])){
                foreach($_POST['checkBoxArray'] as $postIdValue){
                    $bulkOptions = escape($_POST['bulk_options']);
                    switch($bulkOptions){
                        case 'published':
                            $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = {$postIdValue}";
                            $result = mysqli_query($connection, $query);
                            confirm_query($result);
                        break;
                            
                        case 'draft':
                            $query = "UPDATE posts SET post_status = '{$bulkOptions}' WHERE post_id = {$postIdValue}";
                            $result = mysqli_query($connection, $query);
                            confirm_query($result);
                        break;
                        
                        case 'delete':
                            $query = "DELETE FROM posts WHERE post_id = {$postIdValue}";
                            $result = mysqli_query($connection, $query);
                            confirm_query($result);
                        break;
                            
                        case 'clone':
                            $query = "SELECT * FROM posts WHERE post_id = {$postIdValue}";
                            $result = mysqli_query($connection, $query);
                            while($row = mysqli_fetch_assoc($result)){
                                $postId = $row['post_id'];
                                $postAuthor = $row['post_author'];
                                $postTitle = $row['post_title'];
                                $postCategoryId = $row['post_category_id'];
                                $postStatus = $row['post_status'];
                                $postImage = $row['post_image'];
                                $postTags = $row['post_tags'];
                                $postComment = $row['post_comment_count'];
                                $postDate = $row['post_date'];
                            }
                            $clone_query = "INSERT INTO posts (post_author, post_title, post_category_id, post_status, post_image, post_tags, post_comment_count, post_date) ";
                            $clone_query .= "VALUES ('{$postAuthor}', '{$postTitle}', $postCategoryId, '{$postStatus}', '{$postImage}', '{$postTags}', {$postComment}, '{$postDate}')";
                            $clone_query_result = mysqli_query($connection, $clone_query);
                            confirm_query($clone_query_result);
                        break;
                    }
                }
            }
        }
    ?>
    
   <form action="" method="post">
   <table class="table table-bordered table-hover">
   
       <div id="bulkOptionContainer" class="col-xs-4">
           <select name="bulk_options" id="" class="form-control">
              
              <?php
               if(isset($_GET['username'])){
                   ?>
                   <option value="delete">Delete</option>
                   <?php
               } else {
                   ?>
                   <option value="">Choose an option</option>
                   <option value="published">Publish</option>
                   <option value="draft">Draft</option>
                   <option value="clone">Clone</option>
                   <option value="delete">Delete</option>
                   <?php
               }
               ?>
               
           </select>
       </div>
       
       <div class="col-xs-4">
           <input type="submit" name="submit" class="btn btn-success" value="Apply">
           <?php
           if(isset($_GET['username'])){
               $username = escape($_GET['username']);
               echo "<a href='posts.php?source=add&username={$username}' class='btn btn-primary'>Add New</a>";
           } else {
               ?>
               <a href="posts.php?source=add" class="btn btn-primary">Add New</a>
               <?php
           }
           ?>
       </div>
   
    <thead>
        <tr>
           <th><input type="checkbox" id="selectAllBoxes"></th>
            <th>No</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>View Post</th>
            <th>Edit</th>
            <th>Delete</th>
            <th>Views</th>
        </tr>
    </thead>
    <tbody>

        <?php
            if(isset($_GET['username']) && $_SESSION['user_role'] == 'subscriber'){
                $username = escape($_GET['username']);
                //$query = "SELECT * FROM posts WHERE post_author = '{$username}' ";
                
                $query = "SELECT posts.*, categories.* FROM posts ";
                $query .= "LEFT JOIN categories ON posts.post_category_id = categories.cat_id ";
                $query .= "WHERE posts.post_author = '{$username}'";
                
                $result = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($result)){
                    $postId = $row['post_id'];
                    $postAuthor = $row['post_author'];
                    $postTitle = $row['post_title'];
                    $postCatId = $row['post_category_id'];
                    $postStatus = $row['post_status'];
                    $postImage = $row['post_image'];
                    $postTags = $row['post_tags'];
                    $postComments = $row['post_comment_count'];
                    $postDate = $row['post_date'];
                    $postViews = $row['post_views_count'];
                    $categoryID = $row['cat_id'];
                    $categoryTitle = $row['cat_title'];

                    echo "<tr>";
                    ?>

                    <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $postId; ?>"></td>

                    <?php
                    echo "<td>$postId</td>";
                    echo "<td>$postAuthor</td>";
                    echo "<td>$postTitle</td>";

                    /*$select_category = "SELECT * FROM categories WHERE cat_id = {$postCatId}";
                    $select_category_id = mysqli_query($connection, $select_category);

                    while($rows = mysqli_fetch_assoc($select_category_id)){
                        $catId = $rows['cat_id'];
                        $catTitle = $rows['cat_title'];
                        echo "<td>$catTitle</td>";
                    }*/
                    
                    echo "<td>$categoryTitle</td>";

                    echo "<td>$postStatus</td>";
                    echo "<td>
                            <img width='100' src='../images/$postImage'>
                          </td>";
                    echo "<td>$postTags</td>";
                    
                    $count_query = "SELECT * FROM comments WHERE comment_post_id = {$postId}";
                    $count_query_result = mysqli_query($connection, $count_query);
                    confirm_query($count_query_result);
                    $row = mysqli_fetch_assoc($count_query_result);
                    $comment_id = $row['comment_id'];
                    $count = mysqli_num_rows($count_query_result);
                    
                    echo "<td><a href=''>{$count}</a></td>";
                    echo "<td>$postDate</td>";
                    echo "<td><a class='btn btn-primary' href='../post.php?id={$postId}'>View Post</a></td>";
                    echo "<td><a class='btn btn-info' href='posts.php?source=edit_p&username={$username}'>Edit</a></td>";
                    
                    ?>
                    
                    <form method="post">
                        <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
                        <?php
                    echo "<td><input rel='{$postId}' class='btn btn-danger delete_link' type='submit' name='delete' value='Delete'";
                    ?>
                    </form>
                    
                    <?php
                    
                    //echo "<td><a rel='{$postId}' class='delete_link' href='javascript:void(0);'>Delete</a></td>";
                    echo "<td><a href=''>{$postViews}</a></td>";
                }
            } elseif(!isset($_GET['username']) && $_SESSION['user_role'] == 'subscriber'){
                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'subscriber'){
                    ?>
                    <script>
                        alert("This page is only accessible by the admin");
                        window.location = "index.php";
                    </script>
                    <?php
                }
            } else {
                //$query = "SELECT * FROM posts ORDER BY post_id DESC";
                $query = "SELECT posts.*, categories.* FROM posts ";
                $query .= "LEFT JOIN categories ON posts.post_category_id = categories.cat_id ";
                $query .= "ORDER BY posts.post_id DESC";
                $result = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($result)){
                    $postId = $row['post_id'];
                    $postAuthor = $row['post_author'];
                    $postTitle = $row['post_title'];
                    $postCatId = $row['post_category_id'];
                    $postStatus = $row['post_status'];
                    $postImage = $row['post_image'];
                    $postTags = $row['post_tags'];
                    $postComments = $row['post_comment_count'];
                    $postDate = $row['post_date'];
                    $postViews = $row['post_views_count'];
                    $categoryID = $row['cat_id'];
                    $categoryTitle = $row['cat_title'];

                    echo "<tr>";
                    ?>

                    <td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="<?php echo $postId; ?>"></td>

                    <?php
                    echo "<td>$postId</td>";
                    echo "<td>$postAuthor</td>";
                    echo "<td>$postTitle</td>";

                    /*$select_category = "SELECT * FROM categories WHERE cat_id = {$postCatId}";
                    $select_category_id = mysqli_query($connection, $select_category);

                    while($rows = mysqli_fetch_assoc($select_category_id)){
                        $catId = $rows['cat_id'];
                        $catTitle = $rows['cat_title'];
                        echo "<td>$catTitle</td>";
                    }*/
                    
                    echo "<td>$categoryTitle</td>";
                    echo "<td>$postStatus</td>";
                    echo "<td>
                            <img width='100' src='../images/$postImage'>
                          </td>";
                    echo "<td>$postTags</td>";
                    
                    $count_query = "SELECT * FROM comments WHERE comment_post_id = {$postId}";
                    $count_query_result = mysqli_query($connection, $count_query);
                    confirm_query($count_query_result);
                    $row = mysqli_fetch_assoc($count_query_result);
                    $comment_id = $row['comment_id'];
                    $count = mysqli_num_rows($count_query_result);
                    
                    echo "<td><a href='post_comments.php?id={$postId}'>{$count}</a></td>";
                    echo "<td>$postDate</td>";
                     echo "<td><a class='btn btn-primary' href='../post.php?id={$postId}'>View Post</a></td>";
                    echo "<td><a class='btn btn-info' href='posts.php?source=edit&id={$postId}'>Edit</a></td>";
                    
                    ?>
                    
                    <form method="post">
                        <input type="hidden" name="post_id" value="<?php echo $postId; ?>">
                        <?php
                    echo "<td><input rel='{$postId}' class='btn btn-danger delete_link' type='submit' name='delete' value='Delete'";
                    ?>
                    </form>
                    
                    <?php
                    echo "<td><a href=''>{$postViews}</a></td>";
                }
            }
        ?>
        
        <?php        
            if(isset($_POST['delete'])){
                $postId = $_POST['post_id'];
                $query = "DELETE FROM posts WHERE post_id = {$postId}";
                $result = mysqli_query($connection, $query);
                confirm_query($result);
                $query = "DELETE FROM comments WHERE comment_post_id = {$postId}";
                $result = mysqli_query($connection, $query);
                header("Location: posts.php");
            }
        ?>
        
        <script>
            
            $(document).ready(function(){
                $(".delete_link").on('click', function(el){
                    el.preventDefault();
                    let id = $(this).attr('rel');
                    $(".modal_delete_link").val(id);
                    $("#myModal").modal('show');
                });
            });
            
        </script>

    </tbody>
</table>
</form>