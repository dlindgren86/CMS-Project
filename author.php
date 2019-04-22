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
                    if(isset($_GET['p_id'])){
                        $post_id = $_GET['p_id'];
                        $author = $_GET['id'];
                    } else {
                        $post_id = 0;

                    }
                    $query = "SELECT * FROM posts WHERE post_author = '$author' ORDER BY post_id DESC";
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
                        by <?php echo $post_author; ?>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                    <hr>
                    <img class="img-responsive" src="img/<?php echo $post_img; ?>" alt="">
                    <hr>
                    <p><?php echo $post_content; ?></p>

                    <hr>
                 <?php }
                ?>

               <!-- Blog Comments -->
               <?php
               if(isset($_POST['post_comment'])){
                    $post_id = $_GET['p_id'];
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    if(empty($comment_author) && empty($comment_email) && empty($comment_content)){
                        echo "<script>alert('You need to till out all fields')</script>";

                    } else {
                    

                    $query = "INSERT INTO comments(comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                    $query .= "VALUES ($post_id, '$comment_author', '$comment_email', '$comment_content', 'Unapproved', now())";
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
            }
                ?>
            
                        
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include('inc/sidebar.php'); ?>

        </div>
        <!-- /.row -->

        <hr>
<?php include('inc/footer.php'); ?>
   
