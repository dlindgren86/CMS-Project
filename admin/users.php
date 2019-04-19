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
                            case 'add_user';
                            include('inc/add_user.php');
                            break;

                            case 'edit_user';
                            include('inc/edit_user.php');
                            break;

                            default:
                            include('inc/view_users.php');

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