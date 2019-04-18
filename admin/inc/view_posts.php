<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php //Display all posts
        display_posts();
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