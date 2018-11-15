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
                        
                        <div class="col-xs-6">
                           
                            <?php add_categories(); ?>
                                                        
                            <form action="" method="post">
                                <div class="form-group">
                                   <label for="catTitle">Add Category</label>
                                    <input type="text" class="form-control" name="catTitle">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form> 
                            
                            <?php
                                if(isset($_GET['edit'])){
                                    $catId = escape($_GET['edit']);
                                    include "includes/update_categories.php";
                                }
                            ?>
                            
                        </div>
                        
                        <div class="col-xs-6">                            
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  
                                   <?php display_categories(); ?>
                                   
                                   <?php delete_categories(); ?>

                                </tbody>
                            </table>
                        </div>
                        
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