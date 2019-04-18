<?php 

include('inc/db.php');
include('inc/header.php');

?>
    <!-- Navigation -->
    <?php include('inc/navbar.php'); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>
                <?php
                    $query = "SELECT * FROM posts WHERE post_status = 'published' ORDER BY post_id DESC";
                    $postQuery = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($postQuery)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_content = substr($row['post_content'], 0,100);
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_img = $row['post_img'];
                        ?>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                    <hr>
                    <img class="img-responsive" src="img/<?php echo $post_img; ?>" alt="">
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                 <?php 
                }
                ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include('inc/sidebar.php'); ?>

        </div>
        <!-- /.row -->

        <hr>
<?php include('inc/footer.php'); ?>