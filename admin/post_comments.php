  <?php include "includes/admin_header.php"; ?>
   
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to our Admin Page
                            <small>PBNL</small>
                        </h1>
                        
    <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php
            if(isset($_GET['id'])){
                $commentId = escape($_GET['id']);
            }
            $query = "SELECT * FROM comments WHERE comment_post_id = ".mysqli_real_escape_string($connection, $commentId)." ";
            $result = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($result)){
                $commentId = $row['comment_id'];
                $commentPostId = $row['comment_post_id'];
                $commentAuthor = $row['comment_author'];
                $commentContent = $row['comment_content'];
                $commentEmail = $row['comment_email'];
                $commentStatus = $row['comment_status'];
                $commentDate = $row['comment_date'];

                echo "<tr>";
                echo "<td>$commentId</td>";
//                echo "<td>$commentPostId</td>";
                echo "<td>$commentAuthor</td>";
                
//                $select_category = "SELECT * FROM categories WHERE cat_id = {$postCatId}";
//                $select_category_id = mysqli_query($connection, $select_category);
//                
//                while($rows = mysqli_fetch_assoc($select_category_id)){
//                    $catId = $rows['cat_id'];
//                    $catTitle = $rows['cat_title'];
//                    echo "<td>$catTitle</td>";
//                }
                
                echo "<td>$commentContent</td>";
                echo "<td>$commentEmail</td>";
                echo "<td>$commentStatus</td>";
                
                $queries = "SELECT * FROM posts WHERE post_id = $commentPostId";
                $results = mysqli_query($connection, $queries);
                while($rows = mysqli_fetch_assoc($results)){
                    $postId = $rows['post_id'];
                    $postTitle = $rows['post_title'];
                    
                    echo "<td><a href='../post.php?id=$postId'>$postTitle</a></td>";
                }
                
                echo "<td>$commentDate</td>";
                echo "<td><a href='comments.php?id=$commentId&approve=$commentId'>Approve</a>";
                echo "<td><a href='comments.php?id=$commentId&unapprove=$commentId'>Unapprove</a>";
                echo "<td><a href='post_comments.php?id=$commentId&delete=$commentId'>Delete</a>";
            }
        ?>
        
        <?php
        
            if(isset($_GET['approve'])){
                $commentId = escape($_GET['approve']);
                $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$commentId}";
                $result = mysqli_query($connection, $query);
                confirm_query($result);
                header("Location: comments.php?id={$commentId}");
            }
        
            if(isset($_GET['unapprove'])){
                $commentId = escape($_GET['unapprove']);
                $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$commentId}";
                $result = mysqli_query($connection, $query);
                confirm_query($result);
                header("Location: post_comments.php?id={$commentId}");
            }
        
            if(isset($_GET['delete'])){
                $commentId = escape($_GET['delete']);
                $query = "DELETE FROM comments WHERE comment_id = {$commentId}";
                $result = mysqli_query($connection, $query);
                confirm_query($result);  
                header("Location: post_comments.php?id={$commentId}");
            }
        ?>

    </tbody>
</table>

 </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>