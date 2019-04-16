<form action="" method="post">
                            <div class="form-group">
                            <label for="cat_title">Edit Category</label>

                            <?php //Edit Category
                                    if(isset($_GET['edit'])){
                                        $cat_id = $_GET['edit'];
                                        $query = "SELECT * FROM categories WHERE cat_id = {$cat_id}";
                                        $editCategory = mysqli_query($connection, $query);
                                        if(!$editCategory){
                                            die('Query Failed '.mysqli_error($connection));
                                        }
                                        while ($row = mysqli_fetch_assoc($editCategory)){
                                            $cat_title = $row['cat_title'];
                                            $cat_id = $row['cat_id'];
                                        }
                                        ?>
                                    <input value="<?php if(isset($cat_title)){echo $cat_title; } ?>" class="form-control" type="text" name="cat_title">

                                        
                                 <?php   }
                                    ?>
                            <?php //Update Category
                                    if(isset($_POST['update'])){
                                        $cat_title = $_POST['cat_title'];
                                        $cat_id = $_GET['edit'];
                                        if($cat_title == '' OR empty($cat_title)){
                                            echo 'You need to enter a title';
                                        } else {
                                            $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = '{$cat_id}'";
                                            $updateCategory = mysqli_query($connection, $query);
                                            if(!$updateCategory){
                                                die('Query Failed '.mysqli_error($connection));
                                            } else {
                                                header('Location: categories.php');
                                            }
                                        }
                                    }
                            ?>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update" value="Update">
                            </div>
                            </form>