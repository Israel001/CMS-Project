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
                            Welcome to your Administration Page
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
                <?php 
                if(isset($_SESSION['user_role'])){
                    if($_SESSION['user_role'] == 'admin'){
                        ?>
                        <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        
                                        <div class='huge'><?php echo $post_count = record_count('posts'); ?></div>
                                       
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    
                                    <div class='huge'><?php echo $comment_count = record_count('comments'); ?></div>
                                    
                                      <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        
                                        <div class='huge'><?php echo $user_count = record_count('users'); ?></div>
                                    
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        
                                        <div class='huge'><?php echo $category_count = record_count('categories'); ?></div>
                                        
                                         <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                   <?php
                    } else {
                        ?>
                        <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    
                                    <?php
                                        if(isset($_SESSION['user_id'])){
                                            $username = $_SESSION['username'];
                                            $user_id = $_SESSION['user_id'];
                                        }
                                    ?>
                                    <div class='huge'><?php echo record_count_with_condition('posts', 'post_author', $username); ?></div>
                                        <div>Your Posts</div>
                                    </div>
                                </div>
                            </div>
                                <?php echo "<a href='posts.php?source=author&username={$username}'>" ?>
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            <?php echo "</a>"; ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                    
                                    <?php
                                        echo "<div class='huge'>".record_count_with_condition('comments', 'comment_user_id', $user_id)."</div>";
                                    ?>
                                    
                                      <div>Your Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                        </div>
                    <?php
                    $post_count = record_count_with_condition('posts', 'post_author', $username);

                    $comment_count = record_count_with_condition('comments', 'comment_user_id', $user_id);
                    ?>
                     <div class="row">
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['bar']});
                      google.charts.setOnLoadCallback(drawChart);

                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],

                            <?php
                            $element_text = ['Your Posts', 'Your Comments'];
                            $element_count = [$post_count, $comment_count];

                            for($i = 0; $i <= 1; $i++){
                                echo "['{$element_text[$i]}'," . "{$element_count[$i]}],";
                            }
                            ?>

//                          ['Posts', 1000]
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                      }
                    </script>
                    <div id="material" style="width: auto; height: 500px;"></div>
                </div>
                            <?php
                    }
                }
                ?>
                
                
                <?php
                $published_count = record_count_with_condition('posts', 'post_status', 'published');
                
                $draft_count = record_count_with_condition('posts', 'post_status', 'draft');
                            
                $unapproved_comment_count = record_count_with_condition('comments', 'comment_status', 'unapproved');
                
                $subscriber_count = record_count_with_condition('users', 'user_role', 'subscriber');
                ?>
                
                <div class="row">
                    <script type="text/javascript">
                      google.charts.load('current', {'packages':['bar']});
                      google.charts.setOnLoadCallback(drawChart);

                      function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            
                            <?php
                            $element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
                            $element_count = [$post_count, $published_count, $draft_count, $comment_count, $unapproved_comment_count, $user_count, $subscriber_count, $category_count];
                            
                            for($i = 0; $i <= 7; $i++){
                                echo "['{$element_text[$i]}'," . "{$element_count[$i]}],";
                            }
                            ?>
                            
//                          ['Posts', 1000]
                        ]);

                        var options = {
                            hAxis: { title: 'All Posts', titleTextStyle: { color: 'red' } },
                            titleTextStyle: {
                                color: '#343a40'
                            },
                            chart: {
                                title: '',
                                subtitle: '',
                            },
                            backgroundColor: 'transparent',
                            colors: ['#343a40', '#484d53', '#5c6166', '#707579']
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                      }
                    </script>
                    <div id="columnchart_material" style="width: auto; height: 500px;"></div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script src="https://js.pusher.com/4.1/pusher.min.js"></script>
<script>
    $(document).ready(function(){
        let pusher = new Pusher('520861f28781c7215a30', {
            cluster: 'ap1',
            encrypted: true
        });
        
        let notificationChannel = pusher.subscribe('notifications');
        
        notificationChannel.bind('new_user', function(notification){
            let message = notification.message;
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 300;
            toastr.options.closeEasing = 'linear';
            toastr.options.newestOnTop = false;
            toastr.options.onCloseClick = function() {console.log("close button clicked"); };
            toastr.options.extendedTimeOut = 60;
            toastr.success(`${message} just registered`);
            console.log(message);
        });
    });
</script>