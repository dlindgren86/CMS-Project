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
        $post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = $post_id";
        $delete = mysqli_query($connection, $query);
        query_error($delete);
        header('Location: ./posts.php');
    }
?>