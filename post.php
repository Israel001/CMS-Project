<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

<?php
    if(isset($_POST['liked'])){
        $postId = $_POST['post_id'];
        $userId = $_POST['user_id'];
        $query = "SELECT * FROM posts WHERE post_id = {$postId}";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $likes = $row['likes'];
        mysqli_query($connection, "UPDATE posts SET likes = {$likes} + 1 WHERE post_id = {$postId}");
        mysqli_query($connection, "INSERT INTO likes (user_id, post_id) VALUES ({$userId}, {$postId})");
        exit();
    }

    if(isset($_POST['unliked'])){
        $postId = $_POST['post_id'];
        $userId = $_POST['user_id'];
        $query = "SELECT * FROM posts WHERE post_id = {$postId}";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        $likes = $row['likes'];
        mysqli_query($connection, "DELETE FROM likes WHERE post_id = {$postId} AND user_id = {$userId}");
        mysqli_query($connection, "UPDATE posts SET likes = {$likes} - 1 WHERE post_id = {$postId}");
        //mysqli_query($connection, "UPDATE posts SET likes = 0 WHERE post_id = {$postId}");
        exit();
    }
?>
   
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php
                if(isset($_GET['id'])){
                    $postId = $_GET['id'];
                
                $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = {$postId}";
                $result = mysqli_query($connection, $query);
                    
                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                    $query = "SELECT * FROM posts WHERE post_id = {$postId}";
                } else {
                    $query = "SELECT * FROM posts WHERE post_id = {$postId} AND post_status = 'published'";
                }
                
                //$query = "SELECT * FROM posts WHERE post_id = $postId";
                $result = mysqli_query($connection, $query);
                
                if(mysqli_num_rows($result) < 1){
                    echo "<h1 class='text-center'>NO POSTS AVAILABLE</h1>";
                } else {
                    
                while($row = mysqli_fetch_assoc($result)){
                    $postTitle = $row['post_title'];
                    $postAuthor = $row['post_author'];
                    $postDate = $row['post_date'];
                    $postImage = $row['post_image'];
                    $postContent = $row['post_content'];
                    $postCategoryId = $row['post_category_id'];
                    $postUserId = $row['post_user'];
                ?>
                    
                     <h1 class="page-header">
                    <?php 
                        $query1 = "SELECT cat_title FROM categories WHERE cat_id = {$postCategoryId}";
                        $result1 = mysqli_query($connection, $query1);
                        $row = mysqli_fetch_assoc($result1);
                        $header = $row['cat_title'];
                        echo $header;
                    ?>
                    <small><?php echo $postTitle; ?></small>
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $postTitle; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $postAuthor; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $postDate; ?> at 10:00 PM</p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo image_placeholder($postImage); ?>" alt="">
                    <hr>
                    <p><?php echo $postContent; ?></p>
<!--                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>-->

                   <?php } mysqli_free_result($result); ?>
                   
                    <hr>
                    
                    <?php if(isLoggedIn()) { ?>
                    
                    <div class="row">
                        <p class="pull-right" style="font-size: 25px;"><a class="<?php echo userLikedThisPost($postId) ? 'unlike' : 'like'; ?>" href="javascript:void(0);">
                        <span class="<?php echo userLikedThisPost($postId) ? 'glyphicon glyphicon-thumbs-down' : 'glyphicon glyphicon-thumbs-up' ?>"
                        data-toggle = "tooltip"
                        data-placement = "top"
                        title="<?php echo userLikedThisPost($postId) ? 'You liked this post before' : 'Want to like it?' ?>"
                        ></span> <?php echo userLikedThisPost($postId) ? 'Unlike' : 'Like' ?></a></p>
                    </div>
                    
                    <?php } else { ?>
                    
                    <div class="row">
                        <p class="pull-right" style="font-size: 20px;">You need to <a href="/CMS Project/login.php">Login</a> to like this post</p>
                    </div>
                    
                    <?php } ?>
                    
                    <div class="row">
                        <p class="pull-right" style="font-size: 20px;">Likes: <?php getPostLikes($postId); ?></p>
                    </div>
                    
                    <div class="clearfix"></div>
                
                <?php
                    if(isset($_POST['create_comment'])){
                        global $postUserId;
                        $postId = $_GET['id'];
                        $commentAuthor = $_POST['comment_author'];
                        $commentEmail = $_POST['comment_email'];
                        $commentContent = mysqli_real_escape_string($connection, $_POST['comment_content']);
                        
                        if(!empty($commentAuthor) && !empty($commentEmail) && !empty($commentContent)){
                            $query = "INSERT INTO comments(comment_post_id, comment_user_id, comment_author, comment_email, comment_content, comment_date) ";

                            $query .= "VALUES($postId, $postUserId, '{$commentAuthor}', '{$commentEmail}', '{$commentContent}', now())";

                            $create_comment = mysqli_query($connection, $query);

    //                        confirm_query($create_comment);

                            /*$query = "UPDATE posts SET post_comment_count = post_comment_count + 1";
                            $query .= " WHERE post_id = {$postId}";

                            $comment_count = mysqli_query($connection, $query);*/
                        } else {
                            ?>
                            <script>
                                alert("All fields are required");
                            </script>
                            <?php
                        }
                    }
                ?>

               <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                     
                      <div class="form-group">
                           <label for="author">Your Name</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        
                        <div class="form-group">
                           <label for="email">Your Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        
                        <div class="form-group">
                           <label for="comment">Your Comment</label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>
                
                <?php
                
                $query = "SELECT * FROM comments WHERE comment_post_id = {$postId} ";
                $query.= "AND comment_status = 'Approved' ORDER BY comment_id DESC";
                
                $results = mysqli_query($connection, $query);
//                confirm_query($results);
                
                while($rows = mysqli_fetch_assoc($results)){
                    $commentAuthor = $rows['comment_author'];
                    $commentDate = $rows['comment_date'];
                    $commentContent = $rows['comment_content'];    
                ?>

                <!-- Posted Comments -->

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $commentAuthor; ?>
                            <small><?php echo $commentDate; ?></small>
                        </h4>
                        <?php echo $commentContent; ?>
                    </div>
                </div>
                
                <?php 
                    }  } } else {
                        header("Location: index.php");
                    }
                ?>

                <!-- Comment -->
                <!-- <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <!-- Nested Comment -->
                        <!-- <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                    <!-- </div>
                </div>  -->        

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>

        <?php include "includes/footer.php"; ?>

        <script>
            var postId = <?php echo $postId; ?>;
            var userId = <?php echo loggedInUserId(); ?>;
            $(document).ready(function(){
                $("[data-toggle='tooltip']").tooltip();
                $('.like').click(function(){
                    $.ajax({
                        url: "post.php?id="+postId+"",
                        type: 'post',
                        data: {
                            'liked': 1,
                            'post_id': postId,
                            'user_id': userId
                        },
                        success: function(){
                            location.reload(true);
                        }
                    });
                });

                $('.unlike').click(function(){
                    $.ajax({
                        url: "post.php?id="+postId+"",
                        type: 'post',
                        data: {
                            'unliked': 1,
                            'post_id': postId,
                            'user_id': userId
                        },
                        success: function(){
                            location.reload(true);
                        }
                    });
                });
            });
        </script>
