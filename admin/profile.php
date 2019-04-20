<?php include('inc/admin_header.php'); ?>

<?php
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $query = "SELECT * FROM users WHERE username = '$username' ";
        $getProfile = mysqli_query($connection, $query);
        query_error($getProfile);

        while($row = mysqli_fetch_array($getProfile)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $password = $row['password'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $email = $row['email'];
            $user_img = $row['user_img'];
            $user_role = $row['user_role'];
        }
    
   }

   if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $user_img = $_FILES['user_img']['name'];
    $user_img_tmp = $_FILES['user_img']['tmp_name'];
    $user_role = $_POST['user_role'];
    move_uploaded_file($user_img_tmp, "../img/$user_img");
if(empty($user_img)){
    $query = "SELECT * FROM users WHERE user_id = $user_id ";
    $get_img = mysqli_query($connection, $query);
    query_error($get_img);

    while($row = mysqli_fetch_array($get_img)){
        $user_img = $row['user_img'];
    }
}
if(empty($password)){
    $query = "SELECT * FROM users WHERE user_id = $user_id ";
    $get_password = mysqli_query($connection, $query);
    query_error($get_password);

    while($row = mysqli_fetch_array($get_password)){
        $password = $row['password'];
    }
}
$query = "UPDATE users SET ";
$query .= "username = '$username', ";
$query .= "password = '$password', ";
$query .= "first_name = '$first_name', ";
$query .= "last_name = '$last_name', ";
$query .= "email = '$email', ";
$query .= "user_img = '$user_img', ";
$query .= "user_role = '$user_role' ";
$query .= "WHERE user_id = $user_id";
$updateUser = mysqli_query($connection, $query);
query_error($updateUser);
header('Location: profile.php');
}
?>
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

    <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
            <div class="form-group">
                <img width="100px" src="../img/<?php echo $user_img;?>" alt="">
                <input type="file" name="user_img">
            </div>
        </div>
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>">
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label> <br>
            <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>">
        </div>
        <div class="form-group">
            <label for="title">User Role</label> <br>
            <select name="user_role" id="user_role">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            <?php 
            if($user_role == 'Admin'){
                echo "<option value='Subscriber'>Subscriber</option>";
            } else {
                echo "<option value='Admin'>Admin</option>";
            }
            ?>
        </select>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Update">
    </form>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->



<?php include('inc/admin_footer.php'); ?>