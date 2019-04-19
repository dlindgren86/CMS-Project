<?php

function query_error($result){
    global $connection;
    if(!$result){
        die('Query Failed ' . mysqli_error($connection));
    }
}

function insert_categories(){
    global $connection;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == '' OR empty($cat_title)){
            echo 'You need to enter a title';
        } else {
            $query = 'INSERT INTO categories(cat_title)';
            $query .= "VALUE('{$cat_title}')";
            $addCategory = mysqli_query($connection, $query);
            if(!$addCategory){
                die('Query Failed '.mysqli_error($connection));
            }
        }
    }
}

//Find categories on admin/categories
function find_categories(){
    global $connection;
    $query = 'SELECT * FROM categories';
    $selectCategory = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($selectCategory)){
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        echo '<tr>';
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo '</tr>';
    }
}

function delete_category(){
    global $connection;
    if(isset($_GET['delete'])){
        $cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$cat_id}";
        $delete = mysqli_query($connection, $query);
        header("Location: categories.php");
        if(!$delete){
            die('Query Failed '.mysqli_error($connection));
        }
    }
}

function display_posts(){
    global $connection;
    $query = "SELECT * FROM posts ORDER BY post_id DESC";
    $getPosts = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($getPosts)){
        $id = $row['post_id'];
        $author = $row['post_author'];
        $title = $row['post_title'];
        $category_id = $row['post_category_id'];
        $status = $row['post_status'];
        $img = $row['post_img'];
        $tags = $row['post_tags'];
        $comments = $row['post_comment_count'];
        $date = $row['post_date'];
        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$author</td>";
        echo "<td><a href='../post.php?id=$id'>$title</a></td>";
        
        $query = "SELECT * FROM categories WHERE cat_id = $category_id";
        $showCategory = mysqli_query($connection, $query);
        query_error($showCategory);

        while ($row = mysqli_fetch_assoc($showCategory)){
            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];
            echo "<td><a href='../category.php?id=$cat_id'>$cat_title</a></td>";
        }
        echo "<td>$status</td>";
        echo "<td><img width='100px' src='../img/$img'></td>";
        echo "<td>$tags</td>";
        echo "<td>$comments</td>";
        echo "<td>$date</td>";
        echo "<td><a href='posts.php?source=edit_post&id=$id'>Edit</a></td>";
        echo "<td><a href='posts.php?delete=$id'>Delete</a></td>";
        echo "</tr>";
    }
}

function display_comments(){
    global $connection;
    $query = "SELECT * FROM comments ORDER BY comment_id DESC";
    $getComments = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($getComments)){
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
        echo "<tr>";
        echo "<td>$comment_id</td>";
        echo "<td>$comment_author</td>";
        echo "<td>$comment_content</td>";
        echo "<td>$comment_email</td>";
        echo "<td>$comment_status</td>";

        $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
        $showComment = mysqli_query($connection, $query);
        query_error($showComment);

        while ($row = mysqli_fetch_assoc($showComment)){
            $post_title = $row['post_title'];
            $comment_post_id = $row['post_id'];

        echo "<td><a href='../post.php?id=$comment_post_id'>$post_title</a></td>";
        }
        echo "<td>$comment_date</td>";
        echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
        echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";

        echo "</tr>";
    }
}



function display_users(){
    global $connection;
    $query = "SELECT * FROM users";
    $getUsers = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($getUsers)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $password = $row['password'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $user_img = $row['user_img'];
        $user_role = $row['user_role'];
        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$username</td>";
        echo "<td><img width='50px' src='../img/$user_img'></td>";
        echo "<td>$first_name</td>";
        echo "<td>$last_name</td>";
        echo "<td>$email</td>";
        echo "<td>$user_role</td>";

        echo "<td><a href ='users.php?source=edit_user&id=$user_id'>Edit</a></td>";
        echo "<td><a href ='users.php?delete=$user_id'>Delete</a></td>";
        echo "</tr>";
    }
}
?>