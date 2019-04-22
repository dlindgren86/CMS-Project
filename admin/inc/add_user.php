<?php
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

        $query = "INSERT INTO users(username, password, first_name, last_name, email, user_img, user_role) ";
        $query .= "VALUES('{$username}','{$password}','{$first_name}','{$last_name}','{$email}','{$user_img}','{$user_role}')";
        $addUser = mysqli_query($connection, $query);
        query_error($addUser);
        echo "User Added: " . "<a href='users.php'>View Users.</a>";
    }
?>

<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
        <label for="first-name">First Name</label>
        <input type="text" class="form-control" name="first_name">
    </div>
    <div class="form-group">
        <label for="last-name">Last Name</label>
        <input type="text" class="form-control" name="last_name">
    </div>
    <label for="user_role">User Role</label> <br>
    <select name="user_role" id="">
        <option value="Subscriber">Select Option</option>
        <option value="Admin">Admin</option>
        <option value="Subscriber">Subscriber</option>
    </select> <br> <br>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="text" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label for="Email">Email</label>
        <input type="email" class="form-control" name="email">
    </div>
    <div class="form-group">
    <label for="user_img">Profile Picture</label>
        <input type="file" name="user_img">
    </div>
    <input type="submit" class="btn btn-primary" name="submit" value="Add User">




</form>