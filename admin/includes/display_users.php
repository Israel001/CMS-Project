   <table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
<!--            <th>Date</th>-->
        </tr>
    </thead>
    <tbody>

        <?php
            $query = "SELECT * FROM users ORDER BY user_id";
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
                
                if($userId == 0){
                    $userId = 1;
                } else {
                    $userId = $row['user_id'];
                }

                echo "<tr>";
                echo "<td>$userId</td>";
//                echo "<td>$commentPostId</td>";
                echo "<td>$username</td>";
                
//                $select_category = "SELECT * FROM categories WHERE cat_id = {$postCatId}";
//                $select_category_id = mysqli_query($connection, $select_category);
//                
//                while($rows = mysqli_fetch_assoc($select_category_id)){
//                    $catId = $rows['cat_id'];
//                    $catTitle = $rows['cat_title'];
//                    echo "<td>$catTitle</td>";
//                }
                
                echo "<td>$userFirstname</td>";
                echo "<td>$userLastname</td>";
                echo "<td>$userEmail</td>";
                
//                $queries = "SELECT * FROM posts WHERE post_id = $commentPostId";
//                $results = mysqli_query($connection, $queries);
//                while($rows = mysqli_fetch_assoc($results)){
//                    $postId = $rows['post_id'];
//                    $postTitle = $rows['post_title'];
//                    
//                    echo "<td><a href='../post.php?id=$postId'>$postTitle</a></td>";
//                }
                
                echo "<td>$userRole</td>";
                echo "<td><a href='users.php?change_to_admin={$userId}'>Admin</a>";
                echo "<td><a href='users.php?change_to_sub={$userId}'>Subscriber</a>";
                echo "<td><a href='users.php?source=edit&id={$userId}'>Edit</a>";
                echo "<td><a href='users.php?delete={$userId}' onclick=\"return confirm('Are you sure you want to delete {$username}?');\">Delete</a>";
            }
        ?>
        
        <?php
        
            if(isset($_GET['change_to_admin'])){
                $userId = escape($_GET['change_to_admin']);
                $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$userId}";
                $result = mysqli_query($connection, $query);
                confirm_query($result);
                header("Location: users.php");
            }
        
            if(isset($_GET['change_to_sub'])){
                $commentId = escape($_GET['change_to_sub']);
                $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$userId}";
                $result = mysqli_query($connection, $query);
                confirm_query($result);
                header("Location: users.php");
            }
        
            if(isset($_GET['delete'])){
                if(isset($_SESSION['user_role'])){
                    if($_SESSION['user_role'] == 'admin'){
                        $userId = mysqli_real_escape_string($connection, $_GET['delete']);
                        $query = "SELECT * FROM users WHERE user_id = {$userId}";
                        $result = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_assoc($result)){
                            $username = $row['username'];
                        }
                        if($username === $_SESSION['username']){
                            ?>
                            <script>
                                alert("This user cannot be deleted. Please make sure he is not logged in");
                                window.location = "users.php";
                            </script>
                            <?php
                            die();
                        }
                        $query = "DELETE FROM users WHERE user_id = $userId";
                        $result = mysqli_query($connection, $query);
                        confirm_query($result);
                        header("Location: users.php");
                    }
                }
            }
        ?>

    </tbody>
</table>