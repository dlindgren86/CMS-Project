<?php
    if(isset($_POST['submit'])){
        $post_title = $_POST['post_title'];
        $post_category = $_POST['post_category'];
        $post_author = $_POST['post_author'];
        $post_status = $_POST['post_status'];
        $post_img = $_FILES['post_img']['name'];
        $post_img_tmp = $_FILES['post_img']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        $post_comment_count = 4;
        move_uploaded_file($post_img_tmp, "../img/$post_img");

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_img, post_content, post_tags, post_comment_count, post_status) ";
        $query .= "VALUES({$post_category},'{$post_title}','{$post_author}', now(),'{$post_img}','{$post_content}','{$post_tags}',{$post_comment_count}, '{$post_status}')";
        $addPost = mysqli_query($connection, $query);
        query_error($addPost);
    }
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="post_title">
    </div>
    <div class="form-group">
        <label for="title">Category Id</label>
        <input type="text" class="form-control" name="post_category">
    </div>
    <div class="form-group">
        <label for="title">Author</label>
        <input type="text" class="form-control" name="post_author">
    </div>
    <div class="form-group">
        <label for="title">Status</label>
        <input type="text" class="form-control" name="post_status">
    </div>
    <div class="form-group">
        <label for="post_img">Image</label>
        <input type="file" name="post_img">
    </div>
    <div class="form-group">
        <label for="title">Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    <div class="form-group">
        <label for="title">Content</label>
        <textarea type="text" rows="10" class="form-control" name="post_content"></textarea>
    </div>
    <input type="submit" class="btn btn-primary" name="submit" value="Publish">




</form>