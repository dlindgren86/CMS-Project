<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php //Display all posts
        display_comments();
        ?>
    </tbody>
</table>
<?php
    if(isset($_GET['delete'])){
        $comment_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = $comment_id";
        $delete = mysqli_query($connection, $query);
        query_error($delete);
        header('Location: ./comments.php');
    }

    if(isset($_GET['unapprove'])){
        $comment_id = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = '$comment_id'";
        $unapprove = mysqli_query($connection, $query);
        query_error($unapprove);
        header('Location: ./comments.php');
    }

    if(isset($_GET['approve'])){
        $comment_id = $_GET['approve'];
        $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = '$comment_id'";
        $approve = mysqli_query($connection, $query);
        query_error($approve);
        header('Location: ./comments.php');
    }
    
?>