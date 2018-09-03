 
       <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">PBNL</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                
                <?php
                    $query = "SELECT * FROM categories";
                    $result = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($result)){
                        $categoryId = $row['cat_id'];
                        $categoryTitle = $row['cat_title'];
                        
                        //$index_class = '';
                        
                        $category_class = '';
                        
                        $registration_class = '';
                        
                        $contact_class = '';
                        
                        $pagename = basename($_SERVER['PHP_SELF']);
                        
                        if(isset($_GET['id']) && $_GET['id'] == $categoryId){
                            $category_class = 'active';
                        } else {
                            switch($pagename){
                                /*case 'index.php':
                                    //$index_class = 'active';
                                    $registration_class = '';
                                    $contact_class = '';
                                break;*/
                                    
                                case 'registration.php':
                                    $registration_class = 'active';
                                    //$index_class = '';
                                    $contact_class = '';
                                break;
                                    
                                case 'contact.php':
                                    $contact_class = 'active';
                                    //$index_class = '';
                                    $registration_class = '';
                                break;
                            }
                        }
                        
                        
                        echo "<li class='{$category_class}'><a href='category.php?id={$categoryId}'>{$categoryTitle}</a></li>";
                    }
                ?>
                
                <?php if(isLoggedIn()): ?>
                
                <li>
                    <a href="admin/index.php">Admin</a>
                </li>
                
                <li>
                    <a href="includes/logout.php">Logout</a>
                </li>
                
                <?php else: ?>
                
                <li>
                    <a href="login.php">Login</a>
                </li>
                
                <?php endif; ?>
                
                <li class="<?php echo $registration_class;?>">
                    <a href="registration.php">Sign Up</a>
                </li>
                
                <li class="<?php echo $contact_class; ?>">
                    <a href="contact.php">Contact</a>
                </li>
                
                <?php
                    if(isset($_SESSION['user_role'])){
                        if(isset($_GET['id'])){
                            $postId = $_GET['id'];
                            echo "<li><a href='admin/posts.php?source=edit&id={$postId}'>Edit Post</a></li>";
                        }
                    }
                ?>
<!--
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
-->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>