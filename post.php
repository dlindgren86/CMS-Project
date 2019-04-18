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
                    if(isset($_GET['id'])){
                        $post_id = $_GET['id'];
                    } else {
                        $post_id = 0;

                    }
                    $query = "SELECT * FROM posts WHERE post_id = $post_id";
                    $postQuery = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($postQuery)){
                        $post_title = $row['post_title'];
                        $post_content = $row['post_content'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_img = $row['post_img'];

                        ?>

                   

                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?php echo $post_title; ?></a>
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
                 <?php }
                ?>

               <!-- Blog Comments -->
               <?php
               if(isset($_POST['post_comment'])){
                    $post_id = $_GET['id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];
                    

                    $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                    $query .= "VALUES ($post_id, '$comment_author', '$comment_email', '$comment_content', 'unapproved', now())";
                    $post_comment = mysqli_query($connection, $query);

                    if(!$post_comment){
                        die('Query Failed' .mysqli_error($connection));
                    }

                    $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $post_id";
                    $updateCount = mysqli_query($connection, $query);
                    if(!$updateCount){
                        die('Query Failed' .mysqli_error($connection));
                    }
                }
                ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author">                        
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="email" class="form-control" name="comment_email">                        
                        </div>
                        <div class="form-group">
                            <label for="comment_content">Comment</label>
                            <textarea class="form-control" rows="3" name="comment_content"></textarea>
                        </div>
                        <button type="submit" name="post_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
 

                    <?php
                        $post_id = $_GET['id'];
                        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
                        $query .= "AND comment_status = 'Approved'";
                        //$query .= "ORDER BY comment_id DESC";
                        $getComments = mysqli_query($connection, $query);
                            if(!$getComments){
                                die('Query Failed' . mysqli_error($connection));
                            }
                        while($row = mysqli_fetch_assoc($getComments)){
                            $comment_date = $row['comment_date'];
                            $comment_author = $row['comment_author'];
                            $comment_content = $row['comment_content'];
                            ?>
                            <div class="media">
                                <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a>
                                <div class="media-body">
                                <h4 class='media-heading'><?php echo $comment_author; ?>
                                <small><?php echo $comment_date; ?></small>
                                </h4>
                                <?php echo $comment_content; ?>
                                </div>
                            </div>

                            <?php }

                    ?>
                        
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include('inc/sidebar.php'); ?>

        </div>
        <!-- /.row -->

        <hr>
<?php include('inc/footer.php'); ?>
   
