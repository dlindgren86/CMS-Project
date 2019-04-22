<div class="col-md-4">
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                    <div class="input-group">
                        <input name="search" type="text" class="form-control">
                        <span class="input-group-btn">
                            <button name="submit" class="btn btn-default" type="submit">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <?php
                    if(isset($_SESSION['username'])){
                        ?>
                        <div class="well">
                            <h4>You are logged in as:</h4> <?php echo $_SESSION['username']; ?>
                            <a href="admin/profile.php">View Profile</a>
                        </div>
                    <?php } else { ?>

                        <!--Login form -->
                        <div class="well">
                            <h4>Login</h4>
                            <form action="inc/login.php" method="post">
                            <div class="form-group">
                                <input name="username" type="text" class="form-control" placeholder="Username">
                            </div>
                            <div class="input-group">
                                <input name="password" type="password" class="form-control" placeholder="Password">
                                <span class="input-group-btn">
                                <button class="btn btn-primary" name="login" type="submit">Log in</button>
                                </span>                    
                            </div>
                            </form>
                            <!-- /.input-group -->
                        </div>
                   <?php } ?>
                    
                <!-- Blog Categories Well -->
                <div class="well">
                <?php

                $query = 'SELECT * FROM categories';
                $sidebarCategories = mysqli_query($connection, $query);
                
                ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                           <?php 
                            while ($row = mysqli_fetch_assoc($sidebarCategories)){
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];
                                echo "<li>
                                        <a href='category.php?id=$cat_id'>{$cat_title}</a>
                                    </li>";
                             }
                           ?>
                            </ul>
                        </div>
                        <!-- /.col-lg-6 -->
                    </div>
                    <!-- /.row -->
                </div>



                <!-- Side Widget Well -->
                <?php include('widget.php'); ?>

            </div>