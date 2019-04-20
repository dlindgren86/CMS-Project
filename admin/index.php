<?php include('inc/admin_header.php'); ?>

    <div id="wrapper">
        <!-- Navigation -->
        <?php include('inc/admin_navbar.php'); ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Admin Dashboard
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->

       
                <!-- /.row -->
                
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-file-text fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                    <?php
                        $query = "SELECT * FROM posts";
                        $getData = mysqli_query($connection, $query);
                        query_error($getData);
                        $post_count = mysqli_num_rows($getData);
                    ?>
                  <div class='huge'><?php echo $post_count; ?></div>
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
                    <?php
                        $query = "SELECT * FROM comments";
                        $getData = mysqli_query($connection, $query);
                        query_error($getData);
                        $comment_count = mysqli_num_rows($getData);
                    ?>
                     <div class='huge'><?php echo $comment_count; ?></div>
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
                    <?php
                        $query = "SELECT * FROM users";
                        $getData = mysqli_query($connection, $query);
                        query_error($getData);
                        $user_count = mysqli_num_rows($getData);
                    ?>
                    <div class='huge'><?php echo $user_count; ?></div>
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
                    <?php
                        $query = "SELECT * FROM categories";
                        $getData = mysqli_query($connection, $query);
                        query_error($getData);
                        $category_count = mysqli_num_rows($getData);
                    ?>
                        <div class='huge'><?php echo $category_count; ?></div>
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

<?php

$query = "SELECT * FROM posts WHERE post_status = 'Draft'";
$getData = mysqli_query($connection, $query);
query_error($getData);
$draft_count = mysqli_num_rows($getData);

$query = "SELECT * FROM comments WHERE comment_status = 'Unapproved'";
$getData = mysqli_query($connection, $query);
query_error($getData);
$unapproved_count = mysqli_num_rows($getData);

$query = "SELECT * FROM users WHERE user_role = 'Subscriber'";
$getData = mysqli_query($connection, $query);
query_error($getData);
$subscriber_count = mysqli_num_rows($getData);


?>
                <!-- /.row -->
            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                        ['Data', 'Count'],

                        <?php

                            $element_text = ['Active Posts', 'Draft Posts', 'Comments', 'Pending Comments', 'Users', 'Subscribers', 'Categories'];
                            $element_count = [$post_count, $draft_count, $comment_count, $unapproved_count, $user_count, $subscriber_count, $category_count];

                            for($i = 0; $i < 7; $i++){
                                echo "['$element_text[$i]'" . "," . "$element_count[$i]],";
                            }

                        ?>
                        ]);

                        var options = {
                        chart: {
                            title: '',
                            subtitle: '',
                        }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                    <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>
            <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->



<?php include('inc/admin_footer.php'); ?>