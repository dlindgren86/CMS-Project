<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Profile Picture</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>User Role</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php //Display all users
        display_users();
        ?>
    </tbody>
</table>
<?php
    if(isset($_GET['delete'])){
        $user_id = $_GET['delete'];
        $query = "DELETE FROM users WHERE user_id = $user_id";
        $delete = mysqli_query($connection, $query);
        query_error($delete);
        header('Location: ./users.php');
    }
?>