<?php  include "inc/db.php"; ?>
 <?php  include "inc/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "inc/navbar.php"; ?>

    <?php
        if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];

            $username = mysqli_real_escape_string($connection, $username);
            $email = mysqli_real_escape_string($connection, $email);
            $password = mysqli_real_escape_string($connection, $password);
            $confirm_password = mysqli_real_escape_string($connection, $confirm_password);
            $first_name = mysqli_real_escape_string($connection, $first_name);
            $last_name = mysqli_real_escape_string($connection, $last_name);

          if(!empty($username) && !empty($email) && !empty($password) && !empty($confirm_password) && !empty($first_name) && !empty($last_name)){

            if($password !== $confirm_password){
                $msg = 'Passwords does not match.';
            } else {
                $query = "SELECT rand_salt FROM users";
                $select_salt = mysqli_query($connection, $query);
                    if(!$select_salt){
                        die('Query Failed ' . mysqli_error($connection));
                    }

                    $row = mysqli_fetch_array($select_salt);
                    $salt = $row['rand_salt'];
                    $password = crypt($password, $salt);
                    }
                

                $query = "INSERT INTO users(username, email, password, first_name, last_name, user_role) VALUES('$username', '$email', '$password', '$first_name', '$last_name', 'Subscriber')";
                $register = mysqli_query($connection, $query);
        
                if(!$register){
                    die('Query Failed ' .mysqli_error($connection));
                }
                $msg = 'Registration Successful!';

            } else {
                $msg = 'Please fill out all fields.';
          } 
          } else {
              $msg = '';
          }
        
  
    ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                <h4 class="text-center"><?php echo $msg; ?></h4>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                    <div class="form-group">
                            <label for="first_name" class="sr-only">First Name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name">
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="sr-only">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password" class="sr-only">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_key" class="form-control" placeholder="Confirm Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "inc/footer.php";?>