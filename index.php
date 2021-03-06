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
                $per_page = 5;
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                } else {
                    $page = '';
                }
                
                if($page == '' OR $page == 1){
                    $page_1 = 0;
                } else {
                    $page_1 = ($page * $per_page) - $per_page;
                }

                //Find out total amount of posts
                    $post_count = "SELECT * FROM posts";
                    $post_countQuery = mysqli_query($connection, $post_count);
                    $count = mysqli_num_rows($post_countQuery);
                    $count = ceil($count / $per_page); //How many pages in the paginator


                    $query = "SELECT * FROM posts  ORDER BY post_id DESC LIMIT $page_1, $per_page";
                    $postQuery = mysqli_query($connection, $query);
                    
                    while($row = mysqli_fetch_assoc($postQuery)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_content = substr($row['post_content'], 0,100);
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_img = $row['post_img'];
                        $post_status = $row['post_status'];

                        if($post_status == 'Published'){
                        ?>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author.php?id=<?php echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="img/<?php echo $post_img; ?>" alt=""></a>
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>
                 <?php 
                    }
                }
                ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include('inc/sidebar.php'); ?>

        </div>
        <!-- /.row -->
                <ul class="pager">
                <?php
                    for($i = 1; $i <= $count; $i++){

                        if($i == $page){

                            echo "<li><a class='active' href='index.php?page=$i'>$i</a></li>";

                        } else {

                            echo "<li><a href='index.php?page=$i'>$i</a></li>";
                        }
                    }
                ?>

                </ul>
        <hr>
<?php include('inc/footer.php'); ?>