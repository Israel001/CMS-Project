<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php
                if(isset($_GET['id'])){
                    $postId = $_GET['id'];
                    $postAuthor = $_GET['author'];
                }
                
                $query = "SELECT * FROM posts WHERE post_author = '{$postAuthor}' ";
                $result = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($result)){
                    $postTitle = $row['post_title'];
                    $postAuthor = $row['post_author'];
                    $postDate = $row['post_date'];
                    $postImage = $row['post_image'];
                    $postContent = $row['post_content'];
                ?>
                    
                     <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $postTitle; ?></a>
                    </h2>
                    <p class="lead">
                        All posts by <?php echo $postAuthor; ?>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $postDate; ?> at 10:00 PM</p>
                    <hr>
                    <img class="img-responsive" src="images/<?php echo $postImage; ?>" alt="">
                    <hr>
                    <p><?php echo $postContent; ?></p>
<!--                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>-->

                    <hr>
                    
                <?php

                }
                
                ?>
                
                <?php
                    if(isset($_POST['create_comment'])){
                        $postId = $_GET['id'];
                        $commentAuthor = $_POST['comment_author'];
                        $commentEmail = $_POST['comment_email'];
                        $commentContent = mysqli_real_escape_string($connection, $_POST['comment_content']);
                        
                        if(!empty($commentAuthor) && !empty($commentEmail) && !empty($commentContent)){
                            $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_date) ";

                            $query .= "VALUES($postId, '{$commentAuthor}', '{$commentEmail}', '{$commentContent}', now())";

                            $create_comment = mysqli_query($connection, $query);

    //                        confirm_query($create_comment);

                            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1";
                            $query .= " WHERE post_id = {$postId}";

                            $comment_count = mysqli_query($connection, $query);
                        } else {
                            ?>
                            <script>
                                alert("All fields are required");
                            </script>
                            <?php
                        }
                    }
                ?>
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>

        <?php include "includes/footer.php"; ?>