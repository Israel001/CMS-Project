<?php include "includes/admin_header.php"; ?>
  
  <?php

    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $userFirstname = $_SESSION['firstname'];
        $userLastname = $_SESSION['lastname'];
        $userRole = $_SESSION['user_role'];
        $userEmail = $_SESSION['user_email'];
        $userPassword = $_SESSION['user_password'];
        
//        $query = "SELECT * FROM users WHERE username = '{$username}' ";
//        $profile_query = mysqli_query($connection, $query);
//        
//        while($row = mysqli_fetch_assoc($profile_query)){
//            $userId = $row['user_id'];
//            $username = $row['username'];
//            $userPassword = $row['user_password'];
//            $userFirstname = $row['user_firstname'];
//            $userLastname = $row['user_lastname'];
//            $userEmail = $row['user_email'];
//            $userImage = $row['user_image'];
//            $userRole = $row['user_role'];
//        }
    }

   ?>
   
   <?php

    if (isset($_POST['submit'])){
        $userFirstname = mysqli_real_escape_string($connection, $_POST['userFirstname']);
        $userLastname = mysqli_real_escape_string($connection, $_POST['userLastname']);
        $userRole = escape($_POST['user_role']);
        $username = mysqli_real_escape_string($connection, $_POST['username']);
        $userEmail = mysqli_real_escape_string($connection, $_POST['userEmail']);
//        $postImage = $_FILES['postImage']['name'];
//        $postImageTemp = $_FILES['postImage']['tmp_name'];
        $userPassword = mysqli_real_escape_string($connection, $_POST['userPassword']);
//        $postCommentCount = 4;

//        move_uploaded_file($postImageTemp, "../images/$postImage");

            $query = "UPDATE users SET ";
            $query .= "user_firstname = '{$userFirstname}', ";
            $query .= "user_lastname = '{$userLastname}', ";
            $query .= "user_role = '{$userRole}', ";
            $query .= "username = '{$username}', ";
            $query .= "user_email = '{$userEmail}', ";
            $query .= "user_password = '{$userPassword}' ";
            $query .= "WHERE username = '{$username}' ";

            $result = mysqli_query($connection, $query);
    }
            
    ?>
   
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
                        
                       <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control" value="<?php echo $userFirstname; ?>" name="userFirstname">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control" value="<?php echo $userLastname; ?>" name="userLastname">
                        </div>

                        <div class="form-group">
                           <label for="role">Role</label><br>
                            <select class="form-control" name="user_role" id="" disabled>
                                <option value="<?php echo $userRole; ?>"><?php echo $userRole; ?></option>
                                <?php
                                    if($userRole == 'admin'){
                                        echo "<option value='subscriber'>subscriber</option>";
                                    } else {
                                        echo "<option value='admin'>admin</option>";
                                    }
                                ?>
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
                            <input type="text" class="form-control" value="<?php echo $username; ?>" name="username">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" value="<?php echo $userEmail; ?>" name="userEmail">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" value="<?php echo $_SESSION['user_password']; ?>" name="userPassword">
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="submit" value="Update User's Profile">
                        </div>
                    </form>
                                                
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