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
        if($_SESSION['user_role'] == 'admin') {
            $query = "SELECT * FROM comments ORDER BY comment_id DESC";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
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
                while ($rows = mysqli_fetch_assoc($results)) {
                    $postId = $rows['post_id'];
                    $postTitle = $rows['post_title'];

                    echo "<td><a href='../post.php?id=$postId'>$postTitle</a></td>";
                }

                echo "<td>$commentDate</td>";
                echo "<td><a href='comments.php?approve=$commentId'>Approve</a>";
                echo "<td><a href='comments.php?unapprove=$commentId'>Unapprove</a>";
                echo "<td><a href='comments.php?delete=$commentId'>Delete</a>";
            }
        } else {
            $user_id = $_SESSION['user_id'];
            $query = "SELECT * FROM comments WHERE comment_user_id = {$user_id}";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
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
                while ($rows = mysqli_fetch_assoc($results)) {
                    $postId = $rows['post_id'];
                    $postTitle = $rows['post_title'];

                    echo "<td><a href='../post.php?id=$postId'>$postTitle</a></td>";
                }

                echo "<td>$commentDate</td>";
                echo "<td><a href='comments.php?approve=$commentId'>Approve</a>";
                echo "<td><a href='comments.php?unapprove=$commentId'>Unapprove</a>";
                echo "<td><a href='comments.php?delete=$commentId'>Delete</a>";
            }
        }
        ?>
        
        <?php
        
            if(isset($_GET['approve'])){
                $commentId = escape($_GET['approve']);
                $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = {$commentId}";
                $result = mysqli_query($connection, $query);
                confirm_query($result);
                header("Location: comments.php");
            }
        
            if(isset($_GET['unapprove'])){
                $commentId = escape($_GET['unapprove']);
                $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = {$commentId}";
                $result = mysqli_query($connection, $query);
                confirm_query($result);
                header("Location: comments.php");
            }
        
            if(isset($_GET['delete'])){
                $commentId = escape($_GET['delete']);
                $query = "DELETE FROM comments WHERE comment_id = {$commentId}";
                $result = mysqli_query($connection, $query);
                confirm_query($result);
            }
        ?>

    </tbody>
</table>