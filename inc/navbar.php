<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS System</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                        $query = 'SELECT * FROM categories';
                        $navbarCategories = mysqli_query($connection, $query);
                        
                        while ($row = mysqli_fetch_assoc($navbarCategories)){
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            echo "<li>
                                    <a href='category.php?id=$cat_id'>{$cat_title}</a>
                                </li>";
                        }
                    ?>
                     </ul>
                     <ul class="nav navbar-right navbar-nav">
                     <?php
                     if(!isset($_SESSION['user_role'])){
                    echo "<li><a href='registration.php'>Register</a></li>";
                     }
                     ?>
                    <?php
                    if(isset($_SESSION['user_role'])){
                        if(isset($_GET['p_id'])){
                            $p_id = $_GET['p_id'];
                            echo "<li><a href='admin/posts.php?source=edit_post&p_id=$p_id'>Edit Post</a></li>";
                        }
                        echo "<li><a href='admin'>Admin</a></li>";
                    }
              
                    ?>
                    </ul>
                    
                    <!-- 
                    <li>
                        <a href="#">Contact</a>
                    </li> -->
               
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>