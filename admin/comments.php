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
                            <small>Author</small>
                        </h1>
                        <?php
                        if(isset($_GET['source'])){
                            $source = $_GET['source'];
                        } else {
                            $source = '';
                        }
                    
                        switch($source){
                            case 'add_comment';
                            include('inc/add_comment.php');
                            break;

                            case 'edit_comment';
                            include('inc/edit_comment.php');
                            break;

                            default:
                            include('inc/view_comments.php');

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



<?php include('inc/admin_footer.php'); ?>