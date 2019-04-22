<?php
    if(isset($_POST['checkboxArray'])){

        foreach($_POST['checkboxArray'] as $value){

            $bulk_option = $_POST['bulk_option'];

            switch($bulk_option){
                
                case 'Published':
                $query = "UPDATE posts SET post_status = '$bulk_option' WHERE post_id = $value";
                $bulk_update = mysqli_query($connection, $query);
                query_error($bulk_update);
                break;

                case 'Draft':
                $query = "UPDATE posts SET post_status = '$bulk_option' WHERE post_id = $value";
                $bulk_update = mysqli_query($connection, $query);
                query_error($bulk_update);
                break;

                case 'delete':
                $query = "DELETE FROM posts WHERE post_id = $value";
                $bulk_update = mysqli_query($connection, $query);
                query_error($bulk_update);
                break;

                case 'Clone':
                $query = "SELECT * FROM posts WHERE post_id = $value";
                $bulk_update = mysqli_query($connection, $query);
                query_error($bulk_update);
                while($row = mysqli_fetch_array($bulk_update)){
                    $id = $row['post_id'];
                    $author = $row['post_author'];
                    $title = $row['post_title'];
                    $category_id = $row['post_category_id'];
                    $status = $row['post_status'];
                    $img = $row['post_img'];
                    $tags = $row['post_tags'];
                    $comments = $row['post_comment_count'];
                    $date = $row['post_date'];
                    $post_content = $row['post_content'];
                }
                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_status) ";
                $query .= "VALUES({$category_id},'{$title}','{$author}', '$date','{$img}','{$post_content}','{$tags}','{$status}')";
                $addPost = mysqli_query($connection, $query);
                query_error($addPost);
                break;
            }

        }
    }
?>

<form action="" method="post">
    <table class="table table-bordered table-hover">
    <div id="bulkContainer" class="col-xs-4">
        <select class="form-control" name="bulk_option" id="">
            <option value="">Select Option</option>
            <option value="Published">Publish</option>
            <option value="Draft">Draft</option>
            <option value="Clone">Clone</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="col-xs-4">
    <input type="submit" name="submit" class="btn btn-success" value="Apply">
    <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
    </div>
        <thead>
            <tr>
                <th><input id="selectAll" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Views</th>
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
</form>
<?php
    if(isset($_GET['delete'])){
        $post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = $post_id";
        $delete = mysqli_query($connection, $query);
        query_error($delete);
        header('Location: ./posts.php');
    }
?>