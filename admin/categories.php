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
                        <div class="col-xs-6">
                            <?php
                                insert_categories();
                            ?>

                            <form action="" method="post">
                            <div class="form-group">
                            <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add">
                            </div>
                            </form>

                         <?php //Include edit when clicked
                         if(isset($_GET['edit'])){
                            include('inc/edit_category.php');
                         }
                         ?>   

                        </div>

                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                    <?php //Find categories Query
                                    find_categories();?>
                                    <?php // Delete Category
                                    delete_category();?>
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



<?php include('inc/admin_footer.php'); ?>