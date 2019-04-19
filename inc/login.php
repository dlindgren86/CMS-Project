<?php
    include('db.php');
    session_start();
?>

<?php
    if(isset($_POST['login'])){
        $tp_username = $_POST['username'];
        $tp_password = $_POST['password'];

        $tp_username = mysqli_real_escape_string($connection, $tp_username);
        $tp_password = mysqli_real_escape_string($connection, $tp_password);

        $query = "SELECT * FROM users WHERE username = '$tp_username' ";
        $select_user = mysqli_query($connection, $query);
        if(!$select_user){
            die('Query Failed ' . mysqli_error($connection));
        }
    }

    while($row = mysqli_fetch_array($select_user)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $password = $row['password'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $user_role = $row['user_role'];
    }

    if($tp_username === $username && $tp_password === $password){

        $_SESSION['username'] = $username;
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['user_role'] = $user_role;
        header('Location: ../admin');
        
    }  else {

        header('Location: ../index.php');

    }

?>