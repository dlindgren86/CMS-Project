<?php
    if(isset($_GET['id'])){
        $post_id = $_GET['id'];
        $query = "SELECT * FROM posts WHERE post_id = $post_id";
        $edit_post = mysqli_query($connection, $query);
        query_error($edit_post);

        while($row = mysqli_fetch_assoc($edit_post)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_author = $row['post_author'];
            $post_status = $row['post_status'];
            $post_img = $row['post_img'];
            $post_tags = $row['post_tags'];
            $post_content = $row['post_content'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];

        }
    }


?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
        <select name="" id="">
        
        </select>
    </div>
    <div class="form-group">
        <label for="title">Author</label>
        <input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
    </div>
    <div class="form-group">
        <label for="title">Status</label>
        <input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
    </div>
    <div class="form-group">
        <img width="100px" src="../img/<?php echo $post_img;?>" alt="">
    </div>
    <div class="form-group">
        <label for="title">Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
        <label for="title">Content</label>
        <textarea type="text" rows="10" class="form-control" name="post_content"><?php echo $post_content; ?></textarea>
    </div>
    <input type="submit" class="btn btn-primary" name="submit" value="Publish">




</form>