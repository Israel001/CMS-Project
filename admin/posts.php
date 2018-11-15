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
                        
                        <?php
                            if(isset($_GET['source'])){
                                $source = escape($_GET['source']);
                            } else {
                                $source = '';
                            }
                            
                            switch($source){
                                case 'add':
                                    include "includes/add_posts.php";
                                    break;
                                    
                                case 'edit':
                                    include "includes/edit_posts.php";
                                    break;
                                
                                case 'edit_p':
                                    include "includes/edit_user_posts.php";
                                    break;
                                    
                                case '100':
                                    echo "includes/user_posts.php";
                                    break;
                                
                                case '39':
                                    echo "Awesome";
                                    break;
                                
                                default:
                                    include "includes/display_posts.php";
                                    break;
                            }
                        ?>
                                                
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