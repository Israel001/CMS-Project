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
                $per_page = 100;
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                } else {
                    $page = "";
                }
                
                if($page == "" || $page == 1){
                    $page_1 = 0;
                } else {
                    $page_1 = ($page * $per_page) - $per_page;
                }
                
                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                    $query = "SELECT * FROM posts";
                } else {
                    $query = "SELECT * FROM posts WHERE post_status = 'published'";
                }
                
                //$query = "SELECT * FROM posts WHERE post_status = 'published'";
                $result = mysqli_query($connection, $query);
                $count = mysqli_num_rows($result);
                
                if($count < 1){
                    echo "<h1 class='text-center'>NO POSTS AVAILABLE</h1>";
                } else {
                
                $count = ceil($count / $per_page);
                
                $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT $page_1, $per_page";
                $result = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($result)){
                    $postId = $row['post_id'];
                    $postTitle = $row['post_title'];
                    $postAuthor = $row['post_author'];
                    $postDate = $row['post_date'];
                    $postImage = $row['post_image'];
                    $postContent = substr($row['post_content'], 0, 500)."..........";
                    $postStatus = $row['post_status'];
                    $postCategoryId = $row['post_category_id'];
                    
                ?>
                    
                     <h1 class="page-header">
                    <?php 
                        $query1 = "SELECT cat_title FROM categories WHERE cat_id = {$postCategoryId}";
                        $result1 = mysqli_query($connection, $query1);
                        $row1 = mysqli_fetch_assoc($result1);
                        $header = $row1['cat_title'];
                        echo $header;
                    ?>
                    <small><?php echo $postTitle; ?></small>
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?id=<?php echo $postId; ?>"><?php echo $postTitle; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author=<?php echo $postAuthor; ?>&id=<?php echo $postId; ?>"><?php echo $postAuthor; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $postDate; ?> at <?php echo date("h:ia"); ?></p>
                    <hr>
                    
                    <a href="post.php?id=<?php echo $postId; ?>">
                        <img class="img-responsive" src="images/<?php echo image_placeholder($postImage); ?>" alt="">
                    </a>
                    
                    <hr>
                    <p><?php echo $postContent; ?></p>
                    <a class="btn btn-primary" href="post.php?id=<?php echo $postId; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                    
                <?php

                }  }
                
                ?>

               
                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->

        <hr>
        
        <ul class="pager">
            <?php
                for($i = 1; $i < $count; $i++){
                    if($i == $page){
                        echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                    } else {
                        echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                    }
                }
            ?>
        </ul>

        <?php include "includes/footer.php"; ?>